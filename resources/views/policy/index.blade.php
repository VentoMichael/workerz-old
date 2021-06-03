@extends('layouts.app')
@section('content')

    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Notre déclaration de confidentialité
                    </h2>
                    <p>
                        Tous vos droits sont listés ci-dessous
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Online campaign_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    <section class="container-categories-home">
        <h3 aria-level="3" class="container-categories-text-home title-policy">
            Déclaration de confidentialité
        </h3>
        <div class="container-policy show-content">
            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 1 – RENSEIGNEMENTS PERSONNELS RECUEILLIS'))}}</h4>
                <p>
                    Lorsque vous naviguez sur notre boutique, nous recevons automatiquement l’adresse de protocole
                    Internet
                    (adresse IP) de votre ordinateur, qui nous permet d’obtenir plus de détails au sujet du navigateur
                    et du
                    système d’exploitation que vous utilisez.</p>
                <p>

                    Marketing par e-mail (le cas échéant): Avec votre permission, nous pourrions vous envoyer des
                    e-mails au
                    sujet de notre boutique, de nouveaux produits et d’autres mises à jour.</p>
            </section>


            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 2 - CONSENTEMENT'))}}</h4>
                <section>
                    <h4 aria-level="4">Comment obtenez-vous mon consentement&nbsp;?</h4>

                    <p>Si nous vous demandons de nous fournir vos renseignements personnels pour une autre raison, à des
                        fins de
                        marketing par exemple, nous vous demanderons directement votre consentement explicite, ou nous
                        vous
                        donnerons la possibilité de refuser.</p>
                </section>
                <section>

                    <h4 aria-level="4">Comment puis-je retirer mon consentement&nbsp;?</h4>
                    <p>
                        Si après nous avoir donné votre consentement, vous changez d’avis et ne consentez plus à ce que
                        nous
                        puissions vous contacter, recueillir vos renseignements ou les divulguer, vous pouvez nous en
                        aviser en nous
                        contactant à <a href="mailto:vento.michael0705@hotmail.com">vento.michael0705@hotmail.com</a>.
                    </p></section>
            </section>


            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 3 – DIVULGATION'))}}</h4>
                <p>
                    Nous pouvons divulguer vos renseignements personnels si la loi nous oblige à le faire ou si vous
                    violez nos
                    Conditions Générales d’Utilisation.</p>
            </section>


            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 4 – SERVICES FOURNIS PAR DES TIERS'))}}</h4>
                <p>
                    Une fois que vous quittez le site de notre boutique ou que vous êtes redirigé vers le site web ou
                    l’application d’un tiers, vous n’êtes plus régi par la présente Politique de Confidentialité ni par
                    les
                    Conditions Générales d’Utilisation de notre site web.
                </p>

                <section>
                    <h4 aria-level="4">Liens</h4>
                    <p>
                        Vous pourriez être amené à quitter notre site web en cliquant sur certains liens présents sur
                        notre site.
                        Nous n’assumons aucune responsabilité quant aux pratiques de confidentialité exercées par ces
                        autres sites
                        et vous recommandons de lire attentivement leurs politiques de confidentialité.</p>
                </section>
            </section>


            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 5 – SéCURITé'))}}</h4>
                <p>
                    Pour protéger vos données personnelles, nous prenons des précautions raisonnables et suivons les
                    meilleures
                    pratiques de l’industrie pour nous assurer qu’elles ne soient pas perdues, détournées, consultées,
                    divulguées, modifiées ou détruites de manière inappropriée.</p>

            </section>

            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 6 – âGE DE CONSENTEMENT'))}}</h4>
                <p>
                    En utilisant ce site, vous déclarez que vous avez au moins l’âge de la majorité dans votre État ou
                    province
                    de résidence, et que vous nous avez donné votre consentement pour permettre à toute personne d’âge
                    mineur à
                    votre charge d’utiliser ce site web.</p>
            </section>


            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('ARTICLE 7 – MODIFICATIONS APPORTéES À LA PRéSENTE POLITIQUE DE CONFIDENTIALITé'))}}</h4>
                <p>
                    Nous nous réservons le droit de modifier la présente politique de confidentialité à tout moment,
                    donc
                    veuillez s’il vous plait la consulter fréquemment. Les changements et les clarifications prendront
                    effet
                    immédiatement après leur publication sur le site web. Si nous apportons des changements au contenu
                    de cette
                    politique, nous vous aviserons ici qu’elle a été mise à jour, pour que vous sachiez quels
                    renseignements
                    nous recueillons, la manière dont nous les utilisons, et dans quelles circonstances nous les
                    divulguons,
                    s’il y a lieu de le faire.</p></section>


            <section>
                <h4 aria-level="4">{{ucfirst(strtolower('QUESTIONS ET COORDONNéES'))}}</h4>
                <p>
                    Si vous souhaitez: accéder à, corriger, modifier ou supprimer toute information personnelle que nous
                    avons à
                    votre sujet, déposer une plainte, ou si vous souhaitez simplement avoir plus d’informations,
                    contactez notre
                    agent responsable des normes de confidentialité à <a href="mailto:vento.michael0705@hotmail.com">vento.michael0705@hotmail.com</a>.
                </p></section>

        </div>
    </section>
    </section>

@endsection
