<section class="modal" id="modal">
    <div class="modal-header">
        <h3 aria-level="3" class="util-links title">
            Je n'ai rien trouvé avec <i>"{{request('search')}}"</i>&nbsp;!
        </h3>
        <button data-close-button class="crossHideNewsletter" id="crossHide"></button>
    </div>
    <div class="modal-body form-newsletter-popup">
        <p>
            Abonnez-vous à notre newsletter pour recevoir les dernières nouveauté et être au courant de tout&nbsp;! Vous ne serez pas déçu&nbsp;!
        </p>
        <form action="{{route('newsletter.store')}}" method="POST"
              class="form-newsletter-container" title="Inscription à notre newsletter"
              aria-label="Inscription à notre newsletter">
            @csrf
            <div class="form-newsletter">
                <label for="newsletterbox">Votre mail</label>
                <input type="email" required name="newsletter" id="newsletterbox" class="input-newsletter"
                       placeholder="Albert01@gmail.com" aria-required="true">
            </div>
            <div class="form-example">
                <input type="submit" class="submit-newsletter" value="Je m'inscris">
            </div>
        </form>
    </div>
</section>
