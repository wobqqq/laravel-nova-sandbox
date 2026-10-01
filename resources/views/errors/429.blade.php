@include('errors.layout', [
    'code' => 429,
    'title' => 'Too many requests',
    'message' => 'You are sending requests too quickly. Wait a moment and try again.',
])
