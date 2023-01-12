<template>
    <div class="card mb-12">
        <div class="card-header">
            {{ $t('menu_bar.admin_setting_filemanager') }}
        </div>
        <tabs>
            <tab class="list-group-item.active" name="Images">
                <iframe src="/api/laravel-filemanager?type=Images" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            </tab>
            <tab class="list-group-item" name="Files">
                <iframe src="/api/laravel-filemanager?type=Files'" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            </tab>
        </tabs>

    </div>
</template>

<script>
export default {
    name: "FileManager.vue"
}
</script>

<style scoped>

</style>
