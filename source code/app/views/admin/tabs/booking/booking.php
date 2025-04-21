<?php const status = array(
    '0' => 'Chưa xác nhận',
    '1' => 'Đã xác nhận',
    '2' => 'Đã hủy',
    '3' => 'Chưa xác nhận'
); ?>

<div class="overflow-x-auto relative p-6 mx-auto max-w-[1500px] bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
    <div class="flex items-center justify-between mb-6">
        <div>
            <div class="text-3xl font-semibold text-gray-800 dark:text-white">
                Danh sách đặt bàn - <?php echo $data['restaurant_name']; ?>
            </div>
            <div class="mt-2 text-gray-600 dark:text-gray-400">
                Tổng số đặt bàn: <?php echo count($data['bookings']); ?>
            </div>
        </div>
        <a href="<?php echo $path ?>admin/booking"
            class="px-4 py-2 text-white transition duration-300 bg-gray-600 rounded-lg hover:bg-gray-700">
            Quay lại
        </a>
    </div>

    <form method="GET" class="p-4 mb-6 rounded-lg bg-gray-50 dark:bg-gray-700">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="flex flex-col">
                <label for="start_date" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Từ ngày</label>
                <input type="date" id="start_date" name="start_date"
                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
            </div>
            <div class="flex flex-col">
                <label for="end_date" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Đến ngày</label>
                <input type="date" id="end_date" name="end_date"
                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="w-full px-4 py-2.5 text-white bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300">
                    Lọc dữ liệu
                </button>
            </div>
        </div>

        <?php if (isset($_GET['start_date']) || isset($_GET['end_date'])): ?>
            <div class="flex justify-end mt-4">
                <a href="<?php echo $path ?>admin/booking/restaurant_detail/<?php echo $data['restaurant_id']; ?>"
                    class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="mr-1 fas fa-times"></i> Xóa bộ lọc
                </a>
            </div>
        <?php endif; ?>
    </form>

    <?php if (isset($_GET['start_date']) || isset($_GET['end_date'])): ?>
        <div class="p-3 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-300">
            <p class="text-sm">
                Đang hiển thị dữ liệu
                <?php
                if (isset($_GET['start_date']))
                    echo 'từ ' . date('d/m/Y', strtotime($_GET['start_date']));
                if (isset($_GET['end_date']))
                    echo ' đến ' . date('d/m/Y', strtotime($_GET['end_date']));
                ?>
            </p>
        </div>
    <?php endif; ?>

    <table class="w-full text-left text-gray-400 rtl:text-right">
        <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Tên
                </th>
                <th scope="col" class="px-6 py-3">
                    Nhà hàng
                </th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    SĐT
                </th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    Trạng thái
                </th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    Tổng tiền
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Hành động
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['bookings'])
                foreach ($data['bookings'] as $booking) { ?>
                    <tr
                        class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="text-base"><?php echo $booking->fullname ?></div>
                        </th>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $booking->restaurant_name ?>
                        </td>
                        <td
                            class="max-w-xs px-6 py-4 overflow-x-hidden text-gray-900 overflow-ellipsis whitespace-nowrap dark:text-gray-200">
                            <?php echo $booking->phone ?>
                        </td>
                        <td class="max-w-xs px-6 py-4 overflow-x-hidden overflow-ellipsis whitespace-nowrap">
                            <span
                                class="inline-block px-2 py-1 rounded-md <?php echo $booking->status == '1' ? 'bg-green-200 text-green-800' : ($booking->status == '2' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800'); ?>">
                                <?php echo status[$booking->status] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo number_format($booking->money, 0, ',', '.') ?> đ
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="<?php echo $path ?>admin/booking/details/<?php echo $booking->bid ?>"
                                    class="flex items-center justify-center px-3 py-2.5 min-w-[100px] font-medium text-teal-500 rounded-lg border border-teal-500 transition duration-300 ease-in-out transform cursor-pointer hover:text-white hover:bg-teal-500 hover:scale-110">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Chi tiết
                                </a>

                                <a href="<?php echo $path ?>admin/booking/deleteBooking/<?php echo $booking->bid ?>"
                                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    class="flex items-center justify-center px-3 py-2.5 min-w-[100px] font-medium text-rose-500 rounded-lg border border-rose-500 transition duration-300 ease-in-out transform cursor-pointer booking-delete-btn hover:text-white hover:bg-rose-500 hover:scale-110">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
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
        <tfoot class="text-lg font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-gray-700">
            <?php
            $totalMoney = 0;
            if ($data['bookings']) {
                foreach ($data['bookings'] as $booking) {
                    // Chỉ tính tổng tiền cho các booking đã xác nhận (status = 1)
                    if ($booking->status == '1') {
                        $totalMoney += $booking->money;
                    }
                }
            }
            $commission = $totalMoney * 0.1; // Tính hoa hồng 12%
            ?>
            <tr>
                <td colspan="4" class="px-6 py-4 text-right">
                    Tổng tiền (đã xác nhận):
                </td>
                <td class="px-6 py-4">
                    <?php echo number_format($totalMoney, 0, ',', '.') ?> đ
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" class="px-6 py-4 text-right">
                    Hoa hồng (10%):
                </td>
                <td class="px-6 py-4 text-teal-600 dark:text-teal-400">
                    <?php echo number_format($commission, 0, ',', '.') ?> đ
                </td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full p-4">
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
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-200">Xác nhận xóa?</h3>
                <button data-modal-hide="popup-modal" type="button"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-rose-500 rounded-lg transition duration-300 ease-in-out transform booking-confirm-btn hover:bg-rose-600 focus:ring-4 focus:outline-none focus:ring-rose-300 me-2 hover:scale-110">
                    Xác nhận
                </button>
                <button data-modal-hide="popup-modal" type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-500 bg-gray-700 rounded-lg border border-gray-600 transition duration-300 ease-in-out transform hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500 hover:text-white focus:z-10 hover:scale-110">
                    Quay lại
                </button>
            </div>
        </div>
    </div>
</div>