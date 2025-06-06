<div class="container py-5">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
        <div class="container">
            <ol class="py-3 mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-images me-1"></i>Hình ảnh
                </li>
            </ol>
        </div>
    </nav>
    <!-- Header -->
    <div class="mb-5 text-center">
        <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
            Thư Viện Hình Ảnh
            <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
        </h2>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">
        <?php
        if (!empty($data['images']) && count($data['images']) > 0) {
            foreach ($data['images'] as $image) {
                ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100"
                        style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                        <!-- Image Container -->
                        <div class="position-relative" style="height: 250px; overflow: hidden;">
                            <img src="<?= $image['path'] ?>" class="w-100 h-100" alt="<?= $image['restaurant_name'] ?>"
                                style="object-fit: cover; transition: transform 0.5s ease;">

                            <!-- Overlay -->
                            <div class="top-0 position-absolute start-0 w-100 h-100 d-flex align-items-end"
                                style="background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);">
                                <div class="p-3 w-100">
                                    <h5 class="mb-0 text-white">
                                        <?= $image['restaurant_name'] ?>
                                    </h5>
                                </div>
                            </div>

                            <!-- Hover Overlay -->
                            <div class="top-0 opacity-0 position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                style="background: rgba(231, 76, 60, 0.8); transition: all 0.3s ease;">
                                <a href="<?php echo $path ?>user/restaurant/restaurant_detail/<?= $image['r_id'] ?>"
                                    class="p-3 btn btn-light rounded-circle">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="bi bi-image-fill fs-1"></i>
                    <p class="mt-3">Chưa có hình ảnh nào trong thư viện</p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</div>

<style>
    /* Hover Effects */
    .card:hover {
        transform: translateY(-5px);
    }

    .card:hover img {
        transform: scale(1.1);
    }

    .card:hover .opacity-0 {
        opacity: 1 !important;
    }

    /* Optional: Add animation for smoother transitions */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .card {
        animation: fadeIn 0.5s ease-in;
    }

    /* Optional: Add loading skeleton effect */
    .card.loading {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        from {
            background-position: 200% 0;
        }

        to {
            background-position: -200% 0;
        }
    }
</style>

<!-- Optional: Add Lightbox functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize lightbox if you're using a library like Fancybox or Lightbox2
        if (typeof Fancybox !== 'undefined') {
            Fancybox.bind('[data-fancybox="gallery"]', {
                // Custom options
            });
        }
    });
</script>