<div class="overflow-x-auto relative p-6 mx-auto max-w-[1500px] bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
    <div class="flex justify-between items-center mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Danh sách bình luận</div>
        <hr class="border-gray-300 dark:border-gray-700">
    </div>

    <table class="w-[1450px] text-left text-gray-400 rtl:text-right">
        <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 !w-[300px]">
                    Tên
                </th>
                <th scope="col" class="px-6 py-3 !w-[300px]">
                    Nhà hàng
                </th>
                <th scope="col" class="px-6 py-3 !w-[200px]">
                    Nội dung
                </th>
                <th scope="col" class="px-6 py-3 !w-[200px]">
                    Phản hồi
                </th>
                <th scope="col" class="px-6 py-3 !w-[300px]">
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['comments'])
                foreach ($data['comments'] as $comment) { ?>
                    <tr
                        class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white !w-[300px]">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full" src="<?php echo $comment->avatar ?>" alt="avatar">
                                <div class="ps-3">
                                    <div class="text-base font-semibold"><?php echo $comment->name ?></div>
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200 !w-[300px]">
                            <?php echo $comment->restaurant_name ?>
                        </td>
                        <td
                            class="overflow-x-hidden px-6 py-4 max-w-[200px] text-gray-900 overflow-ellipsis whitespace-nowrap dark:text-gray-200 !w-[200px]">
                            <?php echo $comment->cmt ?>
                        </td>
                        <td
                            class="overflow-x-hidden px-6 py-4 max-w-[200px] text-gray-900 overflow-ellipsis whitespace-nowrap dark:text-gray-200 !w-[200px]">
                            <?php echo $comment->reply ?>
                        </td>
                        <td class="px-4 py-4 !w-[300px]">
                            <div class="flex justify-end">
                                <a href="<?php echo $path ?>admin/comment/respond/<?php echo $comment->comid ?>"
                                    class="flex items-center justify-center px-3 py-2.5 mr-2 min-w-[100px] font-medium text-teal-500 rounded-lg border border-teal-500 transition duration-300 ease-in-out transform cursor-pointer hover:text-white hover:bg-teal-500 hover:scale-110">
                                    <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Phản hồi
                                </a>

                                <a href="<?php echo $path ?>admin/comment/delete/<?php echo $comment->comid ?>"
                                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    class="flex items-center justify-center px-3 py-2.5 mr-2 min-w-[100px] font-medium text-rose-500 rounded-lg border border-rose-500 transition duration-300 ease-in-out transform cursor-pointer cmt-delete-btn hover:text-white hover:bg-rose-500 hover:scale-110">
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
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-rose-500 rounded-lg transition duration-300 ease-in-out transform cmt-confirm-btn hover:bg-rose-600 focus:ring-4 focus:outline-none focus:ring-rose-300 me-2 hover:scale-110">
                    Xác nhận
                </button>
                <button data-modal-hide="popup-modal" type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-500 bg-gray-700 rounded-lg border border-gray-600 transition duration-300 ease-in-out transform hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500 hover:text-white focus:z-10 hover:scale-110">Quay
                    lại</button>
            </div>
        </div>
    </div>
</div>