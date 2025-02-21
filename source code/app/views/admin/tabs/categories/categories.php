<div class="relative max-w-[1500px] p-6 mx-auto overflow-x-auto bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
    <div class="flex justify-between items-center mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Danh sách danh mục</div>
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">
            Thêm danh mục
        </button>
    </div>

    <?php if (isset($data['addStatus'])) { ?>
        <div class="mb-4 text-gray-900 dark:text-white">
            <?php if ($data['addStatus']) {
                echo 'Thêm thành công';
            } else {
                echo 'Thêm thất bại';
            } ?>
        </div>
    <?php } ?>

    <table class="w-full text-left text-gray-400 rtl:text-right">
        <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Tên danh mục
                </th>
                <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                    Mã danh mục
                </th>
                <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                    Số lượng nhà hàng
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['categories'])
                foreach ($data['categories'] as $category) { ?>
                    <tr
                        class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center">
                                <img class="mr-4 w-12 h-12 rounded-full" src="<?php echo $category->category_img ?>" alt="img">
                                <?php echo $category->category_name ?>
                            </div>
                        </th>
                        <td class="px-6 py-4 text-center text-gray-900 dark:text-gray-200">
                            <?php echo $category->cateid ?>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-900 dark:text-gray-200">
                            <?php echo $category->num_res ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end">
                                <a href="<?php echo $path ?>admin/category/changeCategory/<?php echo $category->cateid ?>"
                                    class="flex items-center justify-center px-3 py-2.5 mx-1 min-w-[100px] font-medium text-teal-500 rounded-lg border border-teal-500 transition duration-300 ease-in-out transform hover:text-white hover:bg-teal-500 hover:scale-110">
                                    <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Chỉnh sửa
                                </a>

                                <a href="<?php echo $path ?>admin/category/deleteCategory/<?php echo $category->cateid ?>"
                                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    class="cate-delete-btn flex items-center justify-center px-3 py-2.5 mx-1 min-w-[100px] font-medium text-rose-500 rounded-lg border border-rose-500 transition duration-300 ease-in-out transform hover:text-white hover:bg-rose-500 hover:scale-110">
                                    <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Xóa
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-4 rounded-t border-b md:p-5 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Thêm danh mục
                </h3>
                <button type="button"
                    class="inline-flex justify-center items-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-700 hover:text-white ms-auto"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?php echo $path ?>admin/category/addCategory" method="POST" class="p-4 md:p-5">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="category_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên danh mục</label>
                        <input type="text" name="category_name" id="category_name"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Nhập tên danh mục" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="category_img"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ảnh</label>
                        <input type="text" name="category_img" id="category_img"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Nhập đường dẫn ảnh" required="">
                    </div>
                    <button name="addSubmit" type="submit"
                        class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">
                        Thêm danh mục
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 rounded-lg shadow">
            <button type="button"
                class="inline-flex absolute top-3 justify-center items-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg end-2.5 hover:bg-gray-700 hover:text-white ms-auto"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 text-center md:p-5">
                <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-200">Xác nhận xóa?</h3>
                <button data-modal-hide="popup-modal" type="button"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-rose-500 rounded-lg transition duration-300 ease-in-out transform cate-confirm-btn hover:bg-rose-600 focus:ring-4 focus:outline-none focus:ring-rose-300 me-2 hover:scale-110">
                    Xác nhận
                </button>
                <button data-modal-hide="popup-modal" type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-500 bg-gray-700 rounded-lg border border-gray-600 transition duration-300 ease-in-out transform hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500 hover:text-white focus:z-10 hover:scale-110">Quay
                    lại
                </button>
            </div>
        </div>
    </div>
</div>