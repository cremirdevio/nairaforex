@extends('layouts.app')

@section('content')


<div class="uk-section uk-padding-remove-top uk-padding-remove-bottom" style="background-color: #fff;">
  <div class="uk-container uk-padding-remove-horizontal">
    <div class="uk-grid ">
      <div class="uk-width-1-1 uk-margin-small-bottom uk-margin-large-left">
        <h1 class="uk-margin uk-margin-small-bottom">Frequently <span class="in-highlight">Asked</span> Questions</h1>
      </div>
    </div>
  </div>
</div>

<!-- section content begin -->
<div class="uk-section uk-padding-remove-top" style="background-color: #f3f4f6;">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-padding">
      <ul uk-accordion="collapsible: false" class="uk-width-1-1">
        <li>
          <a class="uk-accordion-title" href="#">How do I deposit into my nairaforex account?</a>
          <div class="uk-accordion-content">
            <p>To deposit into your nairaforex account, login and click on “Deposit” and follow the instructions. After
              funding your account you can go ahead to assign a trader to your capital.</p>
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
            <p>Withdrawal is very easy and fast, to withdraw from your account click on “Withdraw” and your withdrawal
              will be processed instantly or maximum of 24hours.</p>
          </div>
        </li>
        <li>
          <a class="uk-accordion-title" href="#">Can I assign multiple funds to multiple traders?</a>
          <div class="uk-accordion-content">
            <p>Yes, you can divide your capital and assign multiple traders to each amount.</p>
          </div>
        </li>
        <li>
          <a class="uk-accordion-title" href="#">What does MBG means?</a>
          <div class="uk-accordion-content">
            <p>MBG means Money Back Guarantee, most nairafx traders offer the money back guarantee, for example 100% MBG
              means if trading is not favorable, you will get back 100% of your capital back.</p>
          </div>
        </li>
        <li>
          <a class="uk-accordion-title" href="#">Do I need to pay before I can assign a trader to my capital?</a>
          <div class="uk-accordion-content">
            <p>NO, you will not be paying any fee to our traders, Nairaforex is responsible for that, we pay our traders
              on a weekly basis and we cover all other expenses also.</p>
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

    <div class="uk-grid uk-flex uk-flex-center">

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
              <h3>Get up to $600 plus 60 days of commission-free stocks &amp; forex trades</h3>
            </div>
            <div class="uk-width-auto">
              <a class="uk-button uk-button-primary uk-border-rounded" href="#">Open an Account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section content end -->

@endsection