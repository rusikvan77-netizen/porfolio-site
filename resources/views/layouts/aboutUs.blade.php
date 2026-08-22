@extends('layouts.app')
@section('content')
    <div class="about-page">
        <!-- Hero-секция -->
        <section class="about-hero">
            <div class="about-container">
                <h1 class="about-title">О <span class="about-highlight">нас</span></h1>
                <p class="about-subtitle">Узнайте больше о нашей компании и команде</p>
            </div>
        </section>

        <div class="about-container">
            <!-- Наша история -->
            <section class="history-section">
                <div class="history-grid">
                    <div class="history-content">
                        <h2>📖 Наша история</h2>
                        <p>
                            Мы — команда энтузиастов, объединённых любовью к видеоиграм и технологиям.
                            Наш магазин был основан с одной простой целью: сделать
                            покупку игр быстрой, удобной и доступной для каждого геймера.
                        </p>
                        <p>
                            За годы работы мы помогли игрокам пополнить
                            свои коллекции, предлагая только лицензионные ключи по лучшим ценам.
                        </p>
                        <p>
                            Мы гордимся тем, что наш сервис выбирают тысячи геймеров по всей России.
                            И это только начало!
                        </p>
                    </div>
                    <div class="history-stats">
                        <div class="stat-card">
                            <span class="stat-number">5+</span>
                            <span class="stat-label">Лет на рынке</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">150K</span>
                            <span class="stat-label">Довольных клиентов</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">1000+</span>
                            <span class="stat-label">Игр в каталоге</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">4.8</span>
                            <span class="stat-label">Средний рейтинг</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Наша миссия -->
            <section class="mission-section">
                <h2>🎯 Наша миссия</h2>
                <div class="mission-grid">
                    <div class="mission-card">
                        <div class="mission-icon">🎮</div>
                        <h3>Доступность</h3>
                        <p>Делаем игры доступными для каждого геймера, предлагая лучшие цены на рынке</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">⚡</div>
                        <h3>Скорость</h3>
                        <p>Мгновенная доставка ключей сразу после оплаты — играй без ожидания</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">🛡️</div>
                        <h3>Надёжность</h3>
                        <p>Только лицензионные ключи от официальных дистрибьюторов с гарантией</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">💬</div>
                        <h3>Поддержка</h3>
                        <p>Круглосуточная поддержка, которая всегда готова помочь вам</p>
                    </div>
                </div>
            </section>

            <!-- Команда -->
            <section class="team-section">
                <h2>👥 Наша команда</h2>
                <p class="team-description">Люди, которые делают ваш игровой опыт незабываемым</p>

                <div class="team-grid">
                    <div class="team-card">
                        <div class="team-avatar">👨‍💻</div>
                        <h3>Владислав Куликов</h3>
                        <span class="team-role">Основатель и CEO</span>
                        <p>Геймер со стажем 25 лет. Мечтал создать лучший магазин игр в России</p>

                    </div>

                    <div class="team-card">
                        <div class="team-avatar">👩‍💻</div>
                        <h3>Мария Петровна</h3>
                        <span class="team-role">Руководитель отдела продаж</span>
                        <p>Знает всё о играх и поможет выбрать идеальный вариант для вас</p>

                    </div>

                    <div class="team-card">
                        <div class="team-avatar">🧑‍💻</div>
                        <h3>Рустам Исмагилов</h3>
                        <span class="team-role">Технический директор</span>
                        <p>Отвечает за то, чтобы наш сайт работал быстро и без сбоев</p>

                    </div>

                    <div class="team-card">
                        <div class="team-avatar">👩‍🎨</div>
                        <h3>Оксана Чеснакова</h3>
                        <span class="team-role">Менеджер по работе с клиентами</span>
                        <p>Всегда на связи и готова решить любой вопрос игроков</p>

                    </div>
                </div>
            </section>

            <!-- Почему выбирают нас -->
            <section class="advantages-section">
                <h2>🏆 Почему выбирают нас</h2>
                <div class="advantages-grid">
                    <div class="advantage-item">
                        <span class="advantage-icon">✅</span>
                        <div>
                            <h4>Только лицензия</h4>
                            <p>Все ключи проходят проверку на подлинность</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <span class="advantage-icon">⚡</span>
                        <div>
                            <h4>Мгновенная доставка</h4>
                            <p>Ключ приходит на почту за 1-5 минут</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <span class="advantage-icon">💳</span>
                        <div>
                            <h4>Удобная оплата</h4>
                            <p>Более 10 способов оплаты на выбор</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <span class="advantage-icon">🔄</span>
                        <div>
                            <h4>Гарантия возврата</h4>
                            <p>Возврат средств в течение 14 дней</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <span class="advantage-icon">🎮</span>
                        <div>
                            <h4>Огромный выбор</h4>
                            <p>Более 1000 игр для всех платформ</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <span class="advantage-icon">💬</span>
                        <div>
                            <h4>Поддержка 24/7</h4>
                            <p>Всегда готовы помочь с любым вопросом</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Контакты -->
            <section class="contacts-section">
                <h2>📞 Свяжитесь с нами</h2>
                <div class="contacts-grid">
                    <div class="contact-card">
                        <i class="fas fa-envelope"></i>
                        <h3>Email</h3>
                        <p>rgalin.77@mail.ru</p>
                    </div>

                    <div class="contact-card">
                        <i class="fab fa-telegram"></i>
                        <h3>Telegram</h3>
                        <p>@Rus_Van_Dal</p>
                    </div>

                    <div class="contact-card">
                        <i class="fab fa-vk"></i>
                        <h3>VK</h3>
                        <p>https://vk.ru/im</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection