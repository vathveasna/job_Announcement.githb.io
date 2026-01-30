<style>
    /* បន្ថែមស្ទីលដើម្បីឱ្យ Footer កាន់តែស្អាត */
    .footer-link {
        text-decoration: none;
        color: #adb5bd; /* ពណ៌ប្រផេះស្រាល */
        transition: 0.3s;
        font-size: 0.9rem;
    }
    .footer-link:hover {
        color: #198754; /* ប្តូរជាពណ៌បៃតងពេលដាក់ Mouse ពីលើ */
        padding-left: 5px;
    }
    .social-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        color: white;
        transition: 0.3s;
        text-decoration: none;
    }
    .social-icon:hover {
        background: #198754;
        color: white;
        transform: translateY(-5px);
    }
</style>

<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-md-start text-center">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4 class="fw-bold text-success mb-3">CareerVibe</h4>
                <p class="text-secondary small" style="line-height: 1.8;">
                    CareerVibe គឺជាគេហទំព័រឈានមុខគេក្នុងការស្វែងរកការងារ និងការជ្រើសរើសបុគ្គលិកនៅក្នុងប្រទេសកម្ពុជា។ យើងជួយអ្នកឱ្យសម្រេចក្តីសុបិនការងាររបស់អ្នក។
                </p>
            </div>

            <div class="col-md-4 mb-4 ps-md-5">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="index.php" class="footer-link">Home</a></li>
                    <li class="mb-2"><a href="find_job.php" class="footer-link">Find Jobs</a></li>
                    <li class="mb-2"><a href="add_job.php" class="footer-link">Post a Job</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">About Us</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Contact Us</h5>
                <p class="text-secondary small mb-2"><i class="bi bi-geo-alt-fill text-success me-2"></i> Phnom Penh, Cambodia</p>
                <p class="text-secondary small mb-3"><i class="bi bi-envelope-fill text-success me-2"></i> info@careervibe.com</p>
                
                <div class="d-flex justify-content-md-start justify-content-center gap-2 mt-3">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-telegram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-secondary opacity-25 my-4">

        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center">
                <p class="mb-0 small text-secondary">&copy; <?php echo date('Y'); ?> <span class="text-success fw-bold">CareerVibe</span>. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-md-end text-center mt-2 mt-md-0">
                <a href="#" class="footer-link me-3">Privacy Policy</a>
                <a href="#" class="footer-link">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>