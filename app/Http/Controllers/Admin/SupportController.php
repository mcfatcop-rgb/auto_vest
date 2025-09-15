<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $supportMessages = SupportMessage::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $stats = [
            'total' => SupportMessage::count(),
            'unread' => SupportMessage::where('admin_read', false)->count(),
            'by_category' => SupportMessage::selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->get(),
        ];

        return view('admin.support.index', compact('supportMessages', 'stats'));
    }

    public function show($id)
    {
        $supportMessage = SupportMessage::with('user')->findOrFail($id);
        
        // Mark as read
        $supportMessage->update(['admin_read' => true]);
        
        return view('admin.support.show', compact('supportMessage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'admin_response' => 'nullable|string|max:2000',
            'status' => 'required|in:pending,in_progress,resolved,closed',
        ]);

        $supportMessage = SupportMessage::findOrFail($id);
        $supportMessage->update([
            'admin_response' => $request->admin_response,
            'status' => $request->status,
            'admin_read' => true,
        ]);

        return back()->with('success', 'Support message updated successfully.');
    }

    public function destroy($id)
    {
        $supportMessage = SupportMessage::findOrFail($id);
        $supportMessage->delete();

        return redirect()->route('admin.support.index')->with('success', 'Support message deleted successfully.');
    }
}

