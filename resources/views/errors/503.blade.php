@include('errors.layout', [
    'code' => 503,
    'title' => 'Service unavailable',
    'message' => 'The application is down for maintenance. Check back soon.',
])
