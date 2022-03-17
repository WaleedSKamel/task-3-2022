<?php

namespace App\Helpers;


trait ApiResponseTrait
{
    public $paginateNumber = 10;

    public function apiResponse($data = null, $error = null, $status = true, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'error' => $error,
        ], $code);
    }

    public function apiResponseData($data = null, $paginate = null, $error = null, $status = true, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'paginate' => $paginate,
            'status' => $status,
            'error' => $error,
        ], $code);
    }

    public function validation($validate, $status = false, $code = 422): \Illuminate\Http\JsonResponse
    {
        return $this->apiResponse('', $validate->errors()->first(), $status, $code);
    }

    public function notFound(): \Illuminate\Http\JsonResponse
    {
        return $this->apiResponse('', 'Not_Found', false, 404);

    }

    public function exception($e): \Illuminate\Http\JsonResponse
    {
        return $this->apiResponse('', $e->getMessage(), false, 520);
    }

    public function paginator($paginator): array
    {
        return [
            'total' => $paginator->total(), // total item return
            'count' => $paginator->count(), // Get the number of items for the current page.
            'currentPage' => $paginator->currentPage(), // Get the current page number.
            'lastPage' => $paginator->lastPage(),  //Get the page number of the last available page. (Not available when using simplePaginate).
            //'firstItem' => $paginator->firstItem(),
            //'getOptions' => $paginator->getOptions(),
            //'hasPages' => $paginator->hasPages(),
            'hasMorePages' => $paginator->hasMorePages(), // Determine if there is more items in the data store.
            //'items' => $paginator->items(),
            //'lastItem' => $paginator->lastItem(),
            'nextPageUrl' => $paginator->nextPageUrl(), // Get the URL for the next page.
            'previousPageUrl' => $paginator->previousPageUrl(), // Get the URL for the previous page.
            //'onFirstPage' => $paginator->onFirstPage(),
            //'getPageName' => $paginator->getPageName(),
        ];
    }


}
