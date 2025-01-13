<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AgentIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function agents()
    {
        $agents = User::query()
            ->select('id', 'name', 'email', 'phone_number')
            ->where('name', '!=', 'admin')
            ->latest()
            ->with(['media', 'properties' => function ($query) {
                $query->orderBy('created_at', 'asc')
                    ->with(['media' => function ($query) {
                        $query->orderBy('order_column', 'asc')
                            ->limit(1);
                    }])
                    ->limit(1);
            }]);

        return $agents->paginate(10);
    }

    public function deleteAgent($id)
    {
        $agent = User::find($id);

        // Can't delete nothing
        if ($agent === null) {
            return redirect()->route('all-agents')->with('error', 'This agent does not exist');
        }

        // Can't delete admin
        if ($agent->hasRole('admin')) {
            return redirect()->route('all-agents')->with('error', 'This agent cannot be deleted');
        }

        // Check for agents properties, if there are no any, soft delete the agent
        if ($agent->properties->count() === 0) {
            try {
                $agent->delete();

                return redirect()->route('all-agents')->with('success', 'Agent deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->route('all-agents')->with('error', 'There was an issue deleting the agent.');
            }
        } else {
            return redirect()->route('all-agents')->with('error', 'This agent cannot be deleted.');
        }
    }
}
