<?php

namespace App\Http\Controllers\Web;

use App\Contracts\CallbackLogRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CallbackLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CallbackLogController extends Controller
{
    private CallbackLogRepositoryInterface $callbackLogRepository;

    public function __construct(CallbackLogRepositoryInterface $callbackLogRepository)
    {
        $this->callbackLogRepository = $callbackLogRepository;
    }

    public function index(Request $request): View
    {
        Gate::authorize('viewAny', CallbackLog::class);

        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $page = $request->get('page', 1);

        if (empty($perPage) || $perPage <= 0) {
            $perPage = 10;
        }

        $callbackLogs = Cache::tags(['callback_logs'])->remember(
            key: "callback_logs:per_page={$perPage}:page={$page}:search={$search}",
            ttl: now()->addHour(),
            callback: fn() => $this->callbackLogRepository->all($perPage, $search)
        );

        if ($request->ajax()) {
            return view('pages.callback-logs.table', compact('callbackLogs'));
        }

        return view('pages.callback-logs.index', compact('callbackLogs', 'perPage', 'search'));
    }

    public function show(CallbackLog $callbackLog): View
    {
        Gate::authorize('view', CallbackLog::class);

        $callbackLog = Cache::remember(
            key: "callback_log:{$callbackLog->id}",
            ttl: now()->addHour(),
            callback: fn() => $this->callbackLogRepository->find($callbackLog)
        );

        return view('pages.callback-logs.show', compact('callbackLog'));
    }
}
