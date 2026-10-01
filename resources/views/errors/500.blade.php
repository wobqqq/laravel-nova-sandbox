@include('errors.layout', [
    'code' => 500,
    'title' => 'Server error',
    'message' => 'Something went wrong on our side. Try again in a moment.',
])
