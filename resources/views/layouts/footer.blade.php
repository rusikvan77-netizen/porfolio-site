<!-- resources/views/layouts/footer.blade.php -->
<footer class="footer">
    <div class="footer-container">
        <!-- Верхняя часть футера -->
        <div class="footer-top">
            <!-- Логотип -->
            <div class="footer-logo-section">
                <a href="{{ url('/FirstPage') }}" class="footer-logo">
                    <span class="logo-text">Player</span>
                    <span class="logo-dot">.</span>
                </a>
                <p class="footer-description">
                    Помогаем покупать игры по самым выгодным ценам.
                </p>
                <div class="footer-socials">
                    <a href="https://twitter.com/yourprofile" class="social-link twitter" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://vk.ru/im" class="social-link vk" aria-label="VK">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="https://web.telegram.org/" class="social-link telegram" aria-label="Telegram">
                        <i class="fab fa-telegram"></i>
                    </a>
                </div>
            </div>

            <div class="footer-links">
                <div class="footer-column">
                    <h4 class="footer-title">
                        <i class="fas fa-life-ring"></i> Помощь
                    </h4>
                    <ul class="footer-list">
                        <li><a href="#" class="footer-link">Часто задаваемые вопросы</a></li>
                        <li><a href="#" class="footer-link">Доставка и оплата</a></li>
                        <li><a href="#" class="footer-link">Возврат товара</a></li>
                        <li><a href="#" class="footer-link">Контакты поддержки</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-title">
                        <i class="fas fa-newspaper"></i> Новости
                    </h4>
                    <ul class="footer-list">
                        <li><a href="#" class="footer-link">Новые наборы</a></li>
                        <li><a href="#" class="footer-link">Акции и скидки</a></li>
                        <li><a href="#" class="footer-link">События и конкурсы</a></li>
                        <li><a href="#" class="footer-link">Блог Player</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-title">
                        <i class="fas fa-file-contract"></i> Условия
                    </h4>
                    <ul class="footer-list">
                        <li><a href="#" class="footer-link">Условия оказания услуг</a></li>
                        <li><a href="#" class="footer-link">Политика конфиденциальности</a></li>
                        <li><a href="#" class="footer-link">Пользовательское соглашение</a></li>
                        <li><a href="#" class="footer-link">Публичная оферта</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-title">
                        <i class="fas fa-address-card"></i> Контакты
                    </h4>
                    <ul class="footer-list">
                        <li>
                            <a href="mailto:info@lego.com" class="footer-link">
                                <i class="fas fa-envelope"></i> rgalin.77@mail.ru
                            </a>
                        </li>
                        <li>
                            <a href="tel:+78005553535" class="footer-link">
                                <i class="fas fa-phone"></i> 8 (800) 555-35-35
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-map-marker-alt"></i> г. Челябинск, ул. Пушкина, д. колотушкино
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                <i class="fas fa-clock"></i> Пн-Вс: 9:00 - 21:00
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-left">
                <p class="copyright">
                    &copy; {{ date('Y') }} Player Store. Все права защищены.
                </p>
            </div>
            <div class="footer-bottom-right">
                <a href="#" class="footer-bottom-link">Политика конфиденциальности</a>
                <span class="footer-divider">|</span>
                <a href="#" class="footer-bottom-link">Cookies</a>
            </div>
        </div>
    </div>
</footer>