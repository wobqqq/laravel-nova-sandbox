@include('errors.layout', [
    'code' => $exception->getStatusCode(),
    'title' => 'Server error',
    'message' => 'Something went wrong on our side. Try again in a moment.',
])
