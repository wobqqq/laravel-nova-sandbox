@include('errors.layout', [
    'code' => 401,
    'title' => 'Unauthorized',
    'message' => 'You need to sign in to see this page.',
])
