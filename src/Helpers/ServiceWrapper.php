<?php

namespace SardarBackend\RestfulApiHelper\Helpers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;

/**
 * Class ServiceWrapper
 * Provides a wrapper for executing database operations within a transaction.
 */
class ServiceWrapper
{
    /**
     * Execute the given action within a database transaction.
     *
     * @param \Closure $action The main action to be executed.
     * @param \Closure|null $reject Optional callback for handling exceptions.
     * @return ServiceResult Returns the result of the operation as a ServiceResult instance.
     */
    public function __invoke(\Closure $action, \Closure $reject = null)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Execute the main action
            $actionResult = $action();

            // Commit the transaction
            DB::commit();

        } catch (\Throwable $th) {
            // Report the exception if a rejection callback is provided
            if (!is_null($reject)) {
                app()[ExceptionHandler::class]->report($th);
            }

            // Roll back the transaction
            DB::rollBack();

            // Return a failed ServiceResult with the exception message
            return new ServiceResult(false, [ 'message' => $th->getMessage()  ]);
        }

        // Ensure $actionResult is not empty; initialize with an empty 'data' array if needed.

        $actionResult= $actionResult->first()? $actionResult : collect(['data'=>[]]);

        // Return a successful ServiceResult with the action result

        return new ServiceResult(true, $actionResult);
    }
}
