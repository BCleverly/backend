<x:backend::search.result
        :title="$model->name"
        :url="route('dashboard.festival.day.edit', $model)"
        description="Created by {{ $model->author->name }}"
        type="Festival Performer"
/>