@extends('layouts.app')
@section('content')
    <div class="contacts-page">
        <!-- Hero-секция -->
        <section class="contacts-hero">
            <div class="contacts-container">
                <h1 class="contacts-title">📞 <span class="contacts-highlight">Контакты</span></h1>
                <p class="contacts-subtitle">Мы всегда на связи и готовы помочь вам</p>
            </div>
        </section>

        <div class="contacts-container">
            <!-- Контактная информация -->
            <section class="info-section">
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">📍</div>
                        <h3>Адрес</h3>
                        <p>г. Челябинск, ул. Пушкина, д. колотушкино</p>
                        <p class="info-desc">Ежедневно с 9:00 до 21:00</p>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">📞</div>
                        <h3>Телефон</h3>
                        <p><a href="tel:+78005553535">8 (800) 555-35-35</a></p>
                        <p class="info-desc">Звонок бесплатный по России</p>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">✉️</div>
                        <h3>Email</h3>
                        <p><a href="mailto:support@yourstore.com">rgalin.77@mail.ru</a></p>
                        <p class="info-desc">Ответ в течение 24 часов</p>
                    </div>
                </div>
            </section>

            <section class="social-section">
                <h2>🌐 Мы в социальных сетях</h2>
                <p class="social-subtitle">Подписывайтесь и будьте в курсе новостей и акций</p>

                <div class="social-grid">
                    <a href="https://t.me/yourstore" target="_blank" class="social-card telegram">
                        <i class="fab fa-telegram"></i>
                        <span>Telegram</span>
                        <small>@RusVanDal</small>
                    </a>

                    <a href="https://vk.com/yourstore" target="_blank" class="social-card vk">
                        <i class="fab fa-vk"></i>
                        <span>ВКонтакте</span>
                        <small>https://vk.ru/rgalin4</small>
                    </a>

                    <a href="https://twitter.com/yourstore" target="_blank" class="social-card twitter">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                        <small>@yourstore</small>
                    </a>

                    <a href="https://discord.gg/yourstore" target="_blank" class="social-card discord">
                        <i class="fab fa-discord"></i>
                        <span>Discord</span>
                        <small>Присоединяйтесь</small>
                    </a>
                </div>
            </section>

            <section class="map-section">
                <h2>🗺️ Мы на карте</h2>
                <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps/embed?pb=%257B55.1611%252C61.4288%257D" width="100%"
                        height="400" style="border:0; border-radius: 16px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </section>

            <!-- Форма обратной связи -->
            <section class="form-section">
                <h2>✉️ Напишите нам</h2>
                <p class="form-subtitle">Заполните форму, и мы свяжемся с вами в ближайшее время</p>

                <form action="#" method="POST" class="contact-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Ваше имя <span class="required">*</span></label>
                            <input type="text" id="name" name="name" placeholder="Иван Иванов" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="ivan@example.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Тема <span class="required">*</span></label>
                        <input type="text" id="subject" name="subject" placeholder="Тема сообщения" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Сообщение <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" placeholder="Опишите ваш вопрос..."
                            required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Отправить сообщение
                    </button>
                </form>
            </section>

        </div>
    </div>
@endsection