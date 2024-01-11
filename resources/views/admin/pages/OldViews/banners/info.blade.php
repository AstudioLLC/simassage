@extends('admin.pages.banners.layout')
@section('title', t('Admin page information.information'))
@section('body')

    @bannerBlock(['title'=>t('Admin page information.contacts')])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>t('Admin page information.send email')])
                    @banner('data.contact_email', t('Admin page information.send email'))
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>t('Admin page information.emails'), 'banners'=>'contacts', 'id'=>2])
                    @banner('email', t('Admin page information.email'))
                @endcards
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>t('Admin page information.phones'), 'banners'=>'contacts'])
                    @banner('phone', t('Admin page information.phone'))
                @endcards
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>t('Admin page information.addresses'), 'banners'=>'contacts', 'id'=>3])
                    @banner('address', t('Admin page information.address'))
                @endcards
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title' => t('Admin page information.socials'), 'banners' => 'socials'])
                    @banner('icon', t('Admin page information.social icons') . ' (5x10)')
                    @banner('title', t('Admin page information.social title'))
                    @banner('url', t('Admin page information.social url'))
                @endcards
            </div>
        </div>
    @endbannerBlock
    @bannerBlock(['title'=>t('Admin page information.title')])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>t('Admin page information.worktime')])
            @banner('data.worktime', t('Admin page information.worktime'))
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>t('Admin page information.map')])
            @banner('data.iframe', t('Admin page information.map url'))
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @cards(['title'=>t('Admin page information.payments'), 'banners'=>'payments'])
                @banner('image', t('Admin page information.payment icons') . ' (45x30)')
                @banner('title', t('Admin page information.payment title'))
                @banner('active', t('Admin page information.payment inactive') . '|' . t('Admin page information.payment active'))
            @endcards
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>'SEO'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>''])
                    @banner('seo.title_suffix', t('Admin page information.seo suffix'))
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
