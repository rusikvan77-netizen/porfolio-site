@extends('layouts.app')
@section('content')
    <!-- Пример FAQ -->
    <section class="about-hero">
        <div class="about-container">
            <h1 class="about-title">Часто задаваемые <span class = "about-highlight"> вопросы</span></h1>
        </div>
    </section>
    <section class="faq-section">
        <div class="faq-item">
            <div class="faq-question">
                <h3>❓ Как купить игру?</h3>
                <span class="toggle-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>1. Выберите игру в каталоге</p>
                <p>2. Нажмите кнопку "Купить"</p>
                <p>3. Оплатите удобным способом</p>
                <p>4. Получите ключ на email</p>
            </div>
        </div>

    </section>
    <section class="guides-section">
        <h2>📚 Инструкции</h2>

        <div class="guide-card">
            <h3>🎮 Как активировать игру в Steam</h3>
            <ol>
                <li>Скачайте и установите Steam</li>
                <li>Войдите в свой аккаунт</li>
                <li>Нажмите "Игры" → "Активировать через Steam"</li>
                <li>Введите полученный ключ</li>
                <li>Игра появится в вашей библиотеке</li>
            </ol>
        </div>

        <div class="guide-card">
            <h3>🟢 Как активировать игру в Epic Games</h3>
            <ol>
                <li>Скачайте и установите Epic Games Launcher</li>
                <li>Войдите в аккаунт</li>
                <li>Нажмите на иконку профиля → "Активировать код"</li>
                <li>Введите ключ и подтвердите</li>
            </ol>
        </div>
    </section>
    <section class="contacts-section">
        <h2>📞 Связь с поддержкой</h2>

        <div class="contacts-grid">
            <div class="contact-card">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>support@yourstore.com</p>
                <p>Ответ в течение 24 часов</p>
            </div>

            <div class="contact-card">
                <i class="fab fa-telegram"></i>
                <h3>Telegram</h3>
                <p>@yourstore_support</p>
                <p>Ответ в течение 1 часа</p>
            </div>

            <div class="contact-card">
                <i class="fab fa-vk"></i>
                <h3>VK</h3>
                <p>vk.com/yourstore</p>
                <p>Ответ в течение 2 часов</p>
            </div>
        </div>
    </section>
    <section class="payment-section">
        <h2>💳 Способы оплаты</h2>

        <div class="payment-grid">
            <div class="payment-method">
                <i class="fas fa-credit-card"></i>
                <span>Банковские карты</span>
                <small>Visa, Mastercard, МИР</small>
            </div>

            <div class="payment-method">
                <i class="fas fa-mobile-alt"></i>
                <span>СБП</span>
                <small>Система быстрых платежей</small>
            </div>

            <div class="payment-method">
                <i class="fas fa-wallet"></i>
                <span>Электронные кошельки</span>
                <small>QIWI, ЮMoney, WebMoney</small>
            </div>

            <div class="payment-method">
                <i class="fas fa-coins"></i>
                <span>Криптовалюта</span>
                <small>Bitcoin, Ethereum</small>
            </div>
        </div>
    </section>
    <section class="delivery-section">
        <h2>🚚 Доставка и возврат</h2>

        <div class="info-block">
            <h3>Доставка</h3>
            <ul>
                <li>Мгновенная доставка ключа на email после оплаты</li>
                <li>Ключ приходит автоматически в течение 1-5 минут</li>
                <li>При задержке - пишите в поддержку</li>
            </ul>
        </div>

        <div class="info-block">
            <h3>Возврат</h3>
            <ul>
                <li>Возврат средств в течение 14 дней</li>
                <li>Если ключ не был активирован</li>
                <li>Для возврата обратитесь в поддержку</li>
            </ul>
        </div>
    </section>
    <section class="status-section">
        <h2>📦 Статусы заказов</h2>

        <div class="status-list">
            <div class="status-item">
                <span class="badge badge-warning">⏳ Ожидает оплаты</span>
                <p>Заказ создан, ожидаем оплату</p>
            </div>

            <div class="status-item">
                <span class="badge badge-info">📧 Оплачено</span>
                <p>Ключ отправлен на email</p>
            </div>

            <div class="status-item">
                <span class="badge badge-success">✅ Выполнен</span>
                <p>Заказ завершен</p>
            </div>

            <div class="status-item">
                <span class="badge badge-danger">❌ Отменен</span>
                <p>Заказ отменен пользователем</p>
            </div>
        </div>
    </section>
@endsection