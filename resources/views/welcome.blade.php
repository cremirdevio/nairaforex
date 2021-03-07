@extends('layouts.landing')

@section('content')
<div class="uk-section uk-padding-remove-vertical">
  <div class="in-slideshow" data-uk-slideshow>
    <ul class="uk-slideshow-items uk-light">
      <li>
        <div class="uk-position-cover">
          <img src="img/in-lazy.gif" data-src="img/in-slideshow-image-1.jpg" alt="slideshow-image" data-uk-cover
            width="1920" height="700" data-uk-img>
        </div>
        <span></span>
        <div class="uk-container">
          <div class="uk-grid" data-uk-grid>
            <div class="uk-width-3-5@m">
              <div class="uk-overlay">
                <h1>Let top traders do the job for you!</h1>
                <p class="uk-text-lead uk-visible@m">Nairaforex allows you to automatically invest with top performing
                  traders and achieve the returns</p>
                <a href="{{ route('traders') }}" class="uk-button uk-button-primary uk-border-rounded uk-visible@m"><i
                    class="fas fa-scroll uk-margin-small-right"></i>Discover Nairaforex</a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="uk-position-cover">
          <img src="img/in-lazy.gif" data-src="img/in-slideshow-image-2.jpg" alt="slideshow-image" data-uk-cover
            width="1920" height="700" data-uk-img>
        </div>
        <span></span>
        <div class="uk-container">
          <div class="uk-grid" data-uk-grid>
            <div class="uk-width-3-5@m">
              <div class="uk-overlay">
                <h1>Get more freedom in the market</h1>
                <p class="uk-text-lead uk-visible@m">A trusted destination for traders worldwide, Authorised by FCA,
                  ASIC &amp; FSCA with multi-lingual support 24/5.</p>
                <a href="{{ route('register') }}" class="uk-button uk-button-primary uk-border-rounded uk-visible@m"><i
                    class="fas fa-scroll uk-margin-small-right"></i>Open Account</a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="uk-position-cover">
          <img src="img/in-lazy.gif" data-src="img/in-slideshow-image-3.jpg" alt="slideshow-image" data-uk-cover
            width="1920" height="700" data-uk-img>
        </div>
        <span></span>
        <div class="uk-container">
          <div class="uk-grid" data-uk-grid>
            <div class="uk-width-3-5@m">
              <div class="uk-overlay">
                <h1>Award-winning Products and Trading platforms</h1>
                <p class="uk-text-lead uk-visible@m">Tap into the world's markets and explore endless trading
                  opportunities with tight spreads and no commission.</p>
                <a href="{{ route('register') }}" class="uk-button uk-button-primary uk-border-rounded uk-visible@m"><i
                    class="fas fa-scroll uk-margin-small-right"></i>Discover it now</a>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <div class="uk-container uk-light">
      <ul class="uk-slideshow-nav uk-dotnav uk-position-bottom-center"></ul>
    </div>
  </div>
</div> <!-- section content begin -->

<div class="uk-section uk-section-primary uk-section-xsmall">
  <div class="uk-container in-wave-1">
    <div class="uk-grid uk-grid-divider uk-child-width-1-2@s uk-child-width-1-4@m in-margin-top@s in-margin-bottom@s"
      data-uk-grid>
      <div>
        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
          <div class="uk-width-auto">
            <img src="img/in-lazy.gif" data-src="img/in-wave-icon-1.svg" alt="wave-icon" width="48" height="48"
              data-uk-img>
          </div>
          <div class="uk-width-expand">
            <p>Create a<br>nairaforex account</p>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
          <div class="uk-width-auto">
            <img src="img/in-lazy.gif" data-src="img/in-wave-icon-2.svg" alt="wave-icon" width="48" height="48"
              data-uk-img>
          </div>
          <div class="uk-width-expand">
            <p>Fund your <br>nairaforex account</p>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
          <div class="uk-width-auto">
            <img src="img/in-lazy.gif" data-src="img/in-wave-icon-3.svg" alt="wave-icon" width="48" height="48"
              data-uk-img>
          </div>
          <div class="uk-width-expand">
            <p>Assign a remote<br> trader of choice</p>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
          <div class="uk-width-auto">
            <img src="img/in-lazy.gif" data-src="img/in-wave-icon-4.svg" alt="wave-icon" width="48" height="48"
              data-uk-img>
          </div>
          <div class="uk-width-expand">
            <p>Get whooping<br> returns</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section content end -->

<!-- section content begin -->
<div class="uk-section uk-padding-large">
  <div class="uk-container in-wave-2">
    <div class="uk-grid">
      <div class="uk-width-4-4@m">
        <h1 class="uk-margin-remove-bottom">Industry-<span class="in-highlight">leading</span> forex traders</h1>
        <p class="uk-text-lead uk-text-muted uk-margin-small-top uk-margin-bottom">Nairaforex enable users to assign
          best remote professional forex traders to their capital and earn reasonable returns within a specific
          duration, Our traders work remotely across Nigeria, South Africa, Kenya and other countries, with
          nairaforex, you can easily assign top forex trader to your dashboard to trade on your behalf and get back
          reasonable returns at the end of the specified duration.</p>
      </div>
    </div>
  </div>
</div>
<!-- section content end -->

<!-- section content begin -->
<div class="uk-section uk-section-muted uk-padding-large in-wave-3 uk-background-contain uk-background-center"
  style="background-image: url(img/in-wave-background-1.png);" data-uk-parallax="bgy: -200">
  <div class="uk-container">
    <div class="uk-grid-large uk-flex uk-flex-middle" data-uk-grid>
      <div class="uk-width-1-2@m uk-inline">
        <img class="uk-margin-bottom uk-position-top-right" src="img/in-lazy.gif" data-src="img/in-wave-icon-5.svg"
          alt="wave-icon" width="64" height="64" data-uk-img>
        <h1 class="uk-margin-remove">Money <span class="in-highlight">back</span> <br>guarantee</h1>
        <p>Most of our remote traders offer Money Back Guarantee (MBG) which means you get back your capital even if
          trade goes sideways. With the help of nairaforex, you are 100% covered.</p>

      </div>
      <div class="uk-width-1-2@m uk-inline">
        <img class="uk-margin-bottom uk-position-top-right" src="img/in-lazy.gif" data-src="img/in-wave-icon-5.svg"
          alt="wave-icon" width="64" height="64" data-uk-img>
        <h1 class="uk-margin-remove">Assign <span class="in-highlight">more</span> than <br>one trader</h1>
        <p>You can divide your capital and assign more than one remote trader to your nairaforex portfolio. You can
          assign up to ten remote traders.</p>

      </div>
    </div>
  </div>
</div>
<!-- section content end -->

<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid">
      <div class="uk-width-1-1 in-card-16">
        <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-border-rounded">
          <div class="uk-grid uk-flex-middle" data-uk-grid>
            <div class="uk-width-1-1 uk-width-expand@m">
              <h3>Get up to 150% commission-free returns on your trades today!</h3>
            </div>
            <div class="uk-width-auto">
              <a class="uk-button uk-button-primary uk-border-rounded" href="{{ route('register') }}">Open an
                Account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section content end -->

<!-- section content begin -->
<div class="uk-section uk-padding-large">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">
      <div class="uk-width-1-1 uk-text-center">
        <h1 class="uk-margin-medium-bottom"><span class="in-highlight">Nairaforex</span> Remote Traders</h1>
      </div>
      <div class="uk-grid uk-text-center uk-width-1-1">
        @forelse($traders as $trader)
        <div class="uk-width-1-2@s uk-width-1-3@m uk-margin-bottom">

          <div class="uk-card uk-card-default uk-card-body uk-padding-remove uk-overflow-hidden">
            <div class="uk-flex uk-flex-left uk-margin-remove uk-padding nf-card-head">
              <div class="uk-inline" style="height: 48px">
                <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
                  <img src="{{ $trader->getThumbnail() }}" alt="Icon" class="nf-icon-size">
                </span>
                <!-- <img src="img/flags/ng.svg" alt="Nigeria office" class="flags-size nf-position-bottom-left"> -->
              </div>
              <div class="uk-flex uk-flex-column uk-margin-left">
                <h4 class="uk-margin-remove nf-table-trader-name">{{ $trader->name }}</h4>
                <span class="uk-text-primary uk-text-left">
                  {{ $trader->getCountry() }} <img src="{{ $trader->getFlag() }}" alt="Nigeria office"
                    class="flags-size">
                </span>
              </div>
            </div>
            <div class="uk-padding nf-card-body">
              <div class="uk-grid uk-margin-remove nf-card-info">
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Estimated Returns</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove nairaforex-positive">{{ $trader->returns }}%
                  </p>
                </div>
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Duration</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove">{{ $trader->duration }}
                    {{ $trader->duration_}}</p>
                </div>
              </div>
              <div class="uk-grid uk-margin-remove nf-card-info">
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Experience</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove">{{ $trader->experience }}</p>
                </div>
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">MBG</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove nairaforex-positive">{{ $trader->mbg }}%</p>
                </div>
              </div>
              <div class="uk-grid uk-flex uk-flex-center uk-margin-remove nf-card-info">
                <div class="uk-width-2-3 uk-flex uk-flex-column uk-text-center uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Rating
                    <span>{{ $trader->rating }}</span>
                  </p>
                  <div>
                    {!! to_rating($trader->rating) !!}
                  </div>
                </div>
              </div>
              <a href="{{ route('traders') }}"
                class="uk-button uk-button-default uk-border-rounded uk-align-center uk-margin-remove">Assign
                trader<i class="fas fa-chevron-circle-right fa-xs uk-margin-small-left"></i></a>
            </div>
          </div>
        </div>

        @empty

        @endforelse

      </div>

    </div>
  </div>
</div>
<!-- section content end -->
<!-- section content begin -->
<div class="uk-section uk-section-default uk-padding-remove-vertical in-wave-5 in-offset-bottom-40">
  <div class="uk-container">
    <div class="uk-grid">
      <div class="uk-width-1-1 uk-background-contain">
        <h2 class="uk-margin-remove-bottom">Frequently <span class="uk-text-primary">asked</span> questions</h2>
        <hr class="nairaforex-hr">

        <ul uk-accordion="collapsible: false">
          <li>
            <a class="uk-accordion-title" href="#">How do I deposit into my nairaforex account?</a>
            <div class="uk-accordion-content">
              <p>To deposit into your nairaforex account, login and click on “Deposit” and follow the instructions.
                After funding your account you can go ahead to assign a trader to your capital.</p>
            </div>
          </li>
          <li>
            <a class="uk-accordion-title" href="#">What is the minimum amount I can assign to a trader?</a>
            <div class="uk-accordion-content">
              <p>The general minimum is N100,000 and maximum of N300 million per individual or corporate bodies.</p>
            </div>
          </li>
          <li>
            <a class="uk-accordion-title" href="#">How do I withdraw from my nairaforex account?</a>
            <div class="uk-accordion-content">
              <p>Withdrawal is very easy and fast, to withdraw from your account click on “Withdraw” and your
                withdrawal will be processed instantly or maximum of 24hours.</p>
            </div>
          </li>
          <li>
            <a class="uk-accordion-title" href="#">Can I assign multiple funds to multiple traders?</a>
            <div class="uk-accordion-content">
              <p>Yes, you can divide your capital and assign multiple traders to each amount./p>
            </div>
          </li>
          <li>
            <a class="uk-accordion-title" href="#">What does MBG means?</a>
            <div class="uk-accordion-content">
              <p>MBG means Money Back Guarantee, most nairafx traders offer the money back guarantee, for example 100%
                MBG means if trading is not favorable, you will get back 100% of your capital back.</p>
            </div>
          </li>
          <li>
            <a class="uk-accordion-title" href="#">Do I need to pay before I can assign a trader to my capital?</a>
            <div class="uk-accordion-content">
              <p>NO, you will not be paying any fee to our traders, Nairaforex is responsible for that, we pay our
                traders on a weekly basis and we cover all other expenses also.</p>
            </div>
          </li>
          <li>
            <a class="uk-accordion-title" href="#">How much fee do nairaforex charge users on transaction?</a>
            <div class="uk-accordion-content">
              <p>We only charge transaction fee on withdrawal which is less than 2% of totalwithdrawal.</p>
            </div>
          </li>
        </ul>

      </div>
    </div>
  </div>

</div>
<!-- section content end -->

@endsection