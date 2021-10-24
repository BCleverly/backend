<x:backend::search.result
        :title="$model->name"
        :description="$model->excerpt"
        :url="route('dashboard.page.edit', $model)"
        type="Page"
/>