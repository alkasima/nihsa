<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageView;
use App\Models\UserSession;
use App\Models\TrafficSource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample sessions
        $sessions = [];
        for ($i = 1; $i <= 50; $i++) {
            $sessionId = 'session_' . $i . '_' . uniqid();
            $isNewVisitor = rand(1, 10) <= 7; // 70% new visitors
            $deviceType = ['desktop', 'mobile', 'tablet'][rand(0, 2)];
            $browser = ['Chrome', 'Safari', 'Firefox', 'Edge'][rand(0, 3)];
            $country = ['Nigeria', 'United States', 'United Kingdom', 'Ghana', 'South Africa'][rand(0, 4)];

            $session = UserSession::create([
                'session_id' => $sessionId,
                'ip_address' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (compatible; AnalyticsSeeder)',
                'device_type' => $deviceType,
                'browser' => $browser,
                'os' => 'Windows',
                'country' => $country,
                'city' => 'Lagos',
                'session_duration' => rand(30, 1800), // 30 seconds to 30 minutes
                'page_count' => rand(1, 10),
                'is_new_visitor' => $isNewVisitor,
                'first_visit_at' => Carbon::now()->subDays(rand(0, 30)),
                'last_activity_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);

            $sessions[] = $session;
        }

        // Create sample page views
        $pages = [
            ['url' => '/', 'title' => 'Home'],
            ['url' => '/about', 'title' => 'About Us'],
            ['url' => '/publications', 'title' => 'Publications'],
            ['url' => '/flood-forecast-dashboard', 'title' => 'Flood Forecast Dashboard'],
            ['url' => '/news', 'title' => 'News'],
            ['url' => '/contact', 'title' => 'Contact'],
            ['url' => '/data-request', 'title' => 'Data Request'],
        ];

        foreach ($sessions as $session) {
            $pageCount = rand(1, 5);
            $startTime = Carbon::parse($session->first_visit_at);

            for ($j = 0; $j < $pageCount; $j++) {
                $page = $pages[array_rand($pages)];
                $visitedAt = $startTime->copy()->addMinutes(rand(0, 30));

                PageView::create([
                    'session_id' => $session->session_id,
                    'url' => $page['url'],
                    'title' => $page['title'],
                    'user_agent' => $session->user_agent,
                    'ip_address' => $session->ip_address,
                    'referrer' => $j > 0 ? $pages[array_rand($pages)]['url'] : null,
                    'device_type' => $session->device_type,
                    'browser' => $session->browser,
                    'browser_version' => '1.0',
                    'os' => $session->os,
                    'country' => $session->country,
                    'city' => $session->city,
                    'latitude' => null,
                    'longitude' => null,
                    'page_load_time' => rand(500, 3000),
                    'time_on_page' => rand(10, 300),
                    'is_bounce' => $pageCount === 1,
                    'visited_at' => $visitedAt,
                ]);
            }
        }

        // Create sample traffic sources
        $sources = ['direct', 'organic', 'referral', 'social', 'email'];
        foreach ($sessions as $session) {
            TrafficSource::create([
                'session_id' => $session->session_id,
                'source' => $sources[array_rand($sources)],
                'medium' => 'search',
                'campaign' => null,
                'referrer_domain' => 'google.com',
                'search_terms' => 'nihsa flood data',
                'created_at' => $session->first_visit_at,
            ]);
        }

        // Create analytics summary for the last 30 days
        for ($days = 0; $days < 30; $days++) {
            $date = Carbon::now()->subDays($days)->toDateString();

            $dayViews = PageView::whereDate('visited_at', $date)->count();
            $daySessions = UserSession::whereDate('first_visit_at', $date)->count();
            $dayVisitors = $daySessions; // Simplified for demo

            DB::table('analytics_summary')->insert([
                'date' => $date,
                'total_visitors' => rand(50, 200),
                'unique_visitors' => rand(40, 180),
                'page_views' => rand(100, 500),
                'sessions' => rand(45, 190),
                'avg_session_duration' => rand(120, 600),
                'bounce_rate' => rand(30, 70),
                'new_visitor_rate' => rand(60, 85),
                'top_pages' => json_encode([
                    ['page' => 'Home', 'views' => rand(50, 150)],
                    ['page' => 'Publications', 'views' => rand(30, 100)],
                    ['page' => 'Flood Dashboard', 'views' => rand(20, 80)],
                ]),
                'traffic_sources' => json_encode([
                    ['source' => 'Direct', 'count' => rand(20, 60)],
                    ['source' => 'Organic Search', 'count' => rand(30, 80)],
                    ['source' => 'Social Media', 'count' => rand(10, 40)],
                ]),
                'device_breakdown' => json_encode([
                    ['device' => 'Desktop', 'count' => rand(40, 70)],
                    ['device' => 'Mobile', 'count' => rand(20, 50)],
                    ['device' => 'Tablet', 'count' => rand(5, 20)],
                ]),
                'browser_breakdown' => json_encode([
                    ['browser' => 'Chrome', 'count' => rand(50, 80)],
                    ['browser' => 'Safari', 'count' => rand(10, 30)],
                    ['browser' => 'Firefox', 'count' => rand(5, 20)],
                ]),
                'country_breakdown' => json_encode([
                    ['country' => 'Nigeria', 'count' => rand(60, 90)],
                    ['country' => 'United States', 'count' => rand(5, 15)],
                    ['country' => 'United Kingdom', 'count' => rand(3, 10)],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Analytics data seeded successfully!');
    }
}
