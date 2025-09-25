<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contact messages
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'unread') {
                $query->unread();
            } elseif ($request->status === 'read') {
                $query->read();
            }
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get counts for the filter tabs
        $totalCount = Contact::count();
        $unreadCount = Contact::unread()->count();
        $readCount = Contact::read()->count();

        return view('admin.contacts.index', compact('contacts', 'totalCount', 'unreadCount', 'readCount'));
    }

    /**
     * Display the specified contact message
     */
    public function show(Contact $contact)
    {
        // Mark as read when viewing
        if (!$contact->is_read) {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Mark a contact message as read
     */
    public function markAsRead(Contact $contact)
    {
        $contact->markAsRead();

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    /**
     * Mark a contact message as unread
     */
    public function markAsUnread(Contact $contact)
    {
        $contact->markAsUnread();

        return redirect()->back()->with('success', 'Message marked as unread.');
    }

    /**
     * Mark multiple messages as read
     */
    public function bulkMarkAsRead(Request $request)
    {
        $contactIds = $request->input('contact_ids', []);

        if (empty($contactIds)) {
            return redirect()->back()->with('error', 'No messages selected.');
        }

        Contact::whereIn('id', $contactIds)->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return redirect()->back()->with('success', count($contactIds) . ' messages marked as read.');
    }

    /**
     * Mark multiple messages as unread
     */
    public function bulkMarkAsUnread(Request $request)
    {
        $contactIds = $request->input('contact_ids', []);

        if (empty($contactIds)) {
            return redirect()->back()->with('error', 'No messages selected.');
        }

        Contact::whereIn('id', $contactIds)->update([
            'is_read' => false,
            'read_at' => null
        ]);

        return redirect()->back()->with('success', count($contactIds) . ' messages marked as unread.');
    }

    /**
     * Remove the specified contact message
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Remove multiple contact messages
     */
    public function bulkDestroy(Request $request)
    {
        $contactIds = $request->input('contact_ids', []);

        if (empty($contactIds)) {
            return redirect()->back()->with('error', 'No messages selected.');
        }

        $deletedCount = Contact::whereIn('id', $contactIds)->delete();

        return redirect()->back()->with('success', $deletedCount . ' messages deleted successfully.');
    }
}
