<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Page views and visits table
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->index();
            $table->string('url')->index();
            $table->string('title')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('referrer')->nullable();
            $table->string('device_type', 20)->default('desktop'); // desktop, mobile, tablet
            $table->string('browser', 50)->nullable();
            $table->string('browser_version')->nullable();
            $table->string('os', 50)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('page_load_time')->nullable(); // in milliseconds
            $table->integer('time_on_page')->nullable(); // in seconds
            $table->boolean('is_bounce')->default(false);
            $table->timestamp('visited_at');
            $table->timestamps();

            $table->index(['visited_at']);
            $table->index(['session_id', 'visited_at']);
        });

        // User sessions table
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->unique()->index();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('device_type', 20)->default('desktop');
            $table->string('browser', 50)->nullable();
            $table->string('os', 50)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('session_duration')->nullable(); // in seconds
            $table->integer('page_count')->default(1);
            $table->boolean('is_new_visitor')->default(true);
            $table->timestamp('first_visit_at');
            $table->timestamp('last_activity_at');
            $table->timestamps();

            $table->index(['first_visit_at']);
            $table->index(['last_activity_at']);
        });

        // Traffic sources table
        Schema::create('traffic_sources', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->index();
            $table->string('source', 50)->index(); // direct, organic, referral, social, email, paid
            $table->string('medium')->nullable(); // search, social, referral, email, cpc, etc.
            $table->string('campaign')->nullable();
            $table->string('referrer_domain')->nullable();
            $table->string('search_terms')->nullable();
            $table->timestamp('created_at');

            $table->index(['created_at']);
        });

        // Popular pages summary table (for caching)
        Schema::create('popular_pages', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique()->index();
            $table->string('title')->nullable();
            $table->integer('total_views')->default(0);
            $table->integer('unique_views')->default(0);
            $table->decimal('avg_time_on_page', 8, 2)->default(0);
            $table->integer('bounce_count')->default(0);
            $table->decimal('bounce_rate', 5, 2)->default(0);
            $table->date('date');
            $table->timestamps();

            $table->index(['date']);
            $table->index(['total_views', 'date']);
        });

        // Analytics summary table (for dashboard)
        Schema::create('analytics_summary', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique()->index();
            $table->integer('total_visitors')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->integer('page_views')->default(0);
            $table->integer('sessions')->default(0);
            $table->decimal('avg_session_duration', 8, 2)->default(0);
            $table->decimal('bounce_rate', 5, 2)->default(0);
            $table->decimal('new_visitor_rate', 5, 2)->default(0);
            $table->json('top_pages')->nullable();
            $table->json('traffic_sources')->nullable();
            $table->json('device_breakdown')->nullable();
            $table->json('browser_breakdown')->nullable();
            $table->json('country_breakdown')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_summary');
        Schema::dropIfExists('popular_pages');
        Schema::dropIfExists('traffic_sources');
        Schema::dropIfExists('user_sessions');
        Schema::dropIfExists('page_views');
    }
};
