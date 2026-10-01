@include('errors.layout', [
    'code' => $exception->getStatusCode(),
    'title' => 'Request error',
    'message' => 'The request could not be completed.',
])
