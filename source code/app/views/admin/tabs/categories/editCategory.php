<form action="<?php echo $path; ?>admin/category/updateCategory/<?php echo $data['category']['cateid']; ?>"
    method="POST" enctype="multipart/form-data"
    class="p-6 mx-auto space-y-8 max-w-6xl bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="flex justify-between items-center">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Chỉnh sửa thông tin danh mục</div>
        <hr class="mb-6 border-gray-300 dark:border-gray-700">
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Tên danh mục -->
        <div class="flex items-center">
            <label for="category_name" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Tên danh
                mục</label>
            <input type="text" name="category_name" id="category_name"
                class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="<?php echo $data['category']['category_name']; ?>">
        </div>

        <!-- Ảnh -->
        <div class="flex items-center">
            <label for="category_image" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Ảnh</label>
            <div class="w-3/4 flex flex-col">
                <div class="flex items-center space-x-4">
                    <input type="file" name="category_image" id="category_image" accept="image/*"
                        class="p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <input type="hidden" name="category_img" id="category_img"
                        value="<?php echo $data['category']['category_img']; ?>">
                </div>
                <div class="mt-2">
                    <img id="preview_image" src="<?php echo $data['category']['category_img']; ?>"
                        class="h-32 w-auto object-cover rounded-lg border border-gray-300" alt="Category preview">
                </div>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Chọn hình ảnh từ máy tính của bạn (JPG, PNG,
                    GIF, WEBP) hoặc giữ nguyên hình ảnh hiện tại.</p>
            </div>
        </div>
    </div>

    <div class="flex justify-end mt-8 space-x-4">
        <button name="editSubmit" type="submit"
            class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">Lưu
            thay đổi</button>
        <a href="<?php echo $path; ?>admin/category"
            class="px-6 py-3 font-semibold text-white bg-rose-500 rounded-lg border border-rose-500 shadow-md transition duration-300 ease-in-out transform hover:bg-rose-600 hover:scale-110 hover:shadow-lg focus:outline-none">Hủy
            bỏ</a>
    </div>
</form>

<script>
// Xử lý hiển thị preview hình ảnh khi chọn file
document.getElementById('category_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_image').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>