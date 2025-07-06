// app/Providers/AuthServiceProvider.php
protected $policies = [
    \App\Models\Property::class => \App\Policies\PropertyPolicy::class,
];
