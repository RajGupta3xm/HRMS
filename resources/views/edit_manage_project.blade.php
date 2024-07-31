@extends('header')

@section('title', 'Edit Project')

@section('content')

<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        <div class="row layout-top-spacing">

            <div class="">

                <div class="row">

                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        <h4>Edit Project</h4>

                    </div>

                </div>

            </div>

            @if ($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach ($errors->all() as $message)

                    <li>{{ $message }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <div id="flLoginForm" class="col-lg-12 layout-spacing">

                <div class="statbox widget box box-shadow">

                    <div class="widget-header">

                        <div class="row">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                <h4>Project Detail</h4>

                            </div>

                        </div>

                    </div>

                    <div class="widget-content widget-content-area">

                        <form method="POST" action="{{ route('Project.update') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Company</label>

                                    <select id="inputState" class="form-select" name="projectcompany">

                                        <option value="{{ $project['projectcompany'] }}">

                                            {{ $project['projectcompany'] }}
                                        </option>

                                    </select>

                                    @error('projectcompany')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Name</label>

                                    <input type="text" name="projectname" class="form-control" placeholder="Project Name" value="{{ old('projectname', $project->projectname) }}">

                                    @error('projectname')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6" data-currency="EUR" data-flags="true">

                                    <label for="inputState" class="form-label">Project Currency</label>

                                    <select class="form-select" id="currency" name="currency">

                                        <option value="" {{ old('currency', $project->currency) === '' ? 'selected' : '' }}>Select

                                            Currency</option>

                                        <option value="AFN" {{ old('currency', $project->currency) === 'AFN' ? 'selected' : '' }}>AFN -

                                            Afghan Afghani - ؋</option>

                                        <option value="ALL" {{ old('currency', $project->currency) === 'ALL' ? 'selected' : '' }}>ALL -

                                            Albanian Lek - Lek</option>

                                        <option value="DZD" {{ old('currency', $project->currency) === 'DZD' ? 'selected' : '' }}>DZD -

                                            Algerian Dinar - دج</option>

                                        <option value="AOA" {{ old('currency', $project->currency) === 'AOA' ? 'selected' : '' }}>AOA -

                                            Angolan Kwanza - Kz</option>

                                        <option value="ARS" {{ old('currency', $project->currency) === 'ARS' ? 'selected' : '' }}>ARS -

                                            Argentine Peso - $</option>

                                        <option value="AMD" {{ old('currency', $project->currency) === 'AMD' ? 'selected' : '' }}>AMD -

                                            Armenian Dram - ֏</option>

                                        <option value="AWG" {{ old('currency', $project->currency) === 'AWG' ? 'selected' : '' }}>AWG -

                                            Aruban Florin - ƒ</option>

                                        <option value="AUD" {{ old('currency', $project->currency) === 'AUD' ? 'selected' : '' }}>AUD -

                                            Australian Dollar - $</option>

                                        <option value="AZN" {{ old('currency', $project->currency) === 'AZN' ? 'selected' : '' }}>AZN -

                                            Azerbaijani Manat - m</option>

                                        <option value="BSD" {{ old('currency', $project->currency) === 'BSD' ? 'selected' : '' }}>BSD -

                                            Bahamian Dollar - B$</option>

                                        <option value="BHD" {{ old('currency', $project->currency) === 'BHD' ? 'selected' : '' }}>BHD -

                                            Bahraini Dinar - .د.ب</option>

                                        <option value="BDT" {{ old('currency', $project->currency) === 'BDT' ? 'selected' : '' }}>BDT -

                                            Bangladeshi Taka - ৳</option>

                                        <option value="BBD" {{ old('currency', $project->currency) === 'BBD' ? 'selected' : '' }}>BBD -

                                            Barbadian Dollar - Bds$</option>

                                        <option value="BYR" {{ old('currency', $project->currency) === 'BYR' ? 'selected' : '' }}>BYR -

                                            Belarusian Ruble - Br</option>

                                        <option value="BEF" {{ old('currency', $project->currency) === 'BEF' ? 'selected' : '' }}>BEF -

                                            Belgian Franc - fr</option>

                                        <option value="BZD" {{ old('currency', $project->currency) === 'BZD' ? 'selected' : '' }}>BZD -

                                            Belize Dollar - $</option>

                                        <option value="BMD" {{ old('currency', $project->currency) === 'BMD' ? 'selected' : '' }}>BMD -

                                            Bermudan Dollar - $</option>

                                        <option value="BTN" {{ old('currency', $project->currency) === 'BTN' ? 'selected' : '' }}>BTN -

                                            Bhutanese Ngultrum - Nu.</option>

                                        <option value="BTC" {{ old('currency', $project->currency) === 'BTC' ? 'selected' : '' }}>BTC -

                                            Bitcoin - ฿</option>

                                        <option value="BOB" {{ old('currency', $project->currency) === 'BOB' ? 'selected' : '' }}>BOB -

                                            Bolivian Boliviano - Bs.</option>

                                        <option value="BAM" {{ old('currency', $project->currency) === 'BAM' ? 'selected' : '' }}>BAM -

                                            Bosnia-Herzegovina Convertible Mark - KM</option>

                                        <option value="BWP" {{ old('currency', $project->currency) === 'BWP' ? 'selected' : '' }}>BWP -

                                            Botswanan Pula - P</option>

                                        <option value="BRL" {{ old('currency', $project->currency) === 'BRL' ? 'selected' : '' }}>BRL -

                                            Brazilian Real - R$</option>

                                        <option value="GBP" {{ old('currency', $project->currency) === 'GBP' ? 'selected' : '' }}>GBP -

                                            British Pound Sterling - £</option>

                                        <option value="BND" {{ old('currency', $project->currency) === 'BND' ? 'selected' : '' }}>BND -

                                            Brunei Dollar - B$</option>

                                        <option value="BGN" {{ old('currency', $project->currency) === 'BGN' ? 'selected' : '' }}>BGN -

                                            Bulgarian Lev - Лв.</option>

                                        <option value="BIF" {{ old('currency', $project->currency) === 'BIF' ? 'selected' : '' }}>BIF -

                                            Burundian Franc - FBu</option>

                                        <option value="KHR" {{ old('currency', $project->currency) === 'KHR' ? 'selected' : '' }}>KHR -

                                            Cambodian Riel - KHR</option>

                                        <option value="CAD" {{ old('currency', $project->currency) === 'CAD' ? 'selected' : '' }}>CAD -

                                            Canadian Dollar - $</option>

                                        <option value="CVE" {{ old('currency', $project->currency) === 'CVE' ? 'selected' : '' }}>CVE -

                                            Cape Verdean Escudo - $</option>

                                        <option value="KYD" {{ old('currency', $project->currency) === 'KYD' ? 'selected' : '' }}>KYD -

                                            Cayman Islands Dollar - $</option>

                                        <option value="XOF" {{ old('currency', $project->currency) === 'XOF' ? 'selected' : '' }}>XOF -

                                            CFA Franc BCEAO - CFA</option>

                                        <option value="XAF" {{ old('currency', $project->currency) === 'XAF' ? 'selected' : '' }}>XAF -

                                            CFA Franc BEAC - FCFA</option>

                                        <option value="XPF" {{ old('currency', $project->currency) === 'XPF' ? 'selected' : '' }}>XPF -

                                            CFP Franc - ₣</option>

                                        <option value="CLP" {{ old('currency', $project->currency) === 'CLP' ? 'selected' : '' }}>CLP -

                                            Chilean Peso - $</option>

                                        <option value="CNY" {{ old('currency', $project->currency) === 'CNY' ? 'selected' : '' }}>CNY -

                                            Chinese Yuan - ¥</option>

                                        <option value="COP" {{ old('currency', $project->currency) === 'COP' ? 'selected' : '' }}>COP -

                                            Colombian Peso - $</option>

                                        <option value="KMF" {{ old('currency', $project->currency) === 'KMF' ? 'selected' : '' }}>KMF -

                                            Comorian Franc - CF</option>

                                        <option value="CDF" {{ old('currency', $project->currency) === 'CDF' ? 'selected' : '' }}>CDF -

                                            Congolese Franc - FC</option>

                                        <option value="CRC" {{ old('currency', $project->currency) === 'CRC' ? 'selected' : '' }}>CRC -

                                            Costa Rican ColÃ³n - ₡</option>

                                        <option value="HRK" {{ old('currency', $project->currency) === 'HRK' ? 'selected' : '' }}>HRK -

                                            Croatian Kuna - kn</option>

                                        <option value="CUC" {{ old('currency', $project->currency) === 'CUC' ? 'selected' : '' }}>CUC -

                                            Cuban Convertible Peso - $, CUC</option>

                                        <option value="CZK" {{ old('currency', $project->currency) === 'CZK' ? 'selected' : '' }}>CZK -

                                            Czech Republic Koruna - Kč</option>

                                        <option value="DKK" {{ old('currency', $project->currency) === 'DKK' ? 'selected' : '' }}>DKK -

                                            Danish Krone - Kr.</option>

                                        <option value="DJF" {{ old('currency', $project->currency) === 'DJF' ? 'selected' : '' }}>DJF -

                                            Djiboutian Franc - Fdj</option>

                                        <option value="DOP" {{ old('currency', $project->currency) === 'DOP' ? 'selected' : '' }}>DOP -

                                            Dominican Peso - $</option>

                                        <option value="XCD" {{ old('currency', $project->currency) === 'XCD' ? 'selected' : '' }}>XCD -

                                            East Caribbean Dollar - $</option>

                                        <option value="EGP" {{ old('currency', $project->currency) === 'EGP' ? 'selected' : '' }}>EGP -

                                            Egyptian Pound - ج.م</option>

                                        <option value="ERN" {{ old('currency', $project->currency) === 'ERN' ? 'selected' : '' }}>ERN -

                                            Eritrean Nakfa - Nfk</option>

                                        <option value="EEK" {{ old('currency', $project->currency) === 'EEK' ? 'selected' : '' }}>EEK -

                                            Estonian Kroon - kr</option>

                                        <option value="ETB" {{ old('currency', $project->currency) === 'ETB' ? 'selected' : '' }}>ETB -

                                            Ethiopian Birr - Nkf</option>

                                        <option value="EUR" {{ old('currency', $project->currency) === 'EUR' ? 'selected' : '' }}>EUR -

                                            Euro - €</option>

                                        <option value="FKP" {{ old('currency', $project->currency) === 'FKP' ? 'selected' : '' }}>FKP -

                                            Falkland Islands Pound - £</option>

                                        <option value="FJD" {{ old('currency', $project->currency) === 'FJD' ? 'selected' : '' }}>FJD -

                                            Fijian Dollar - FJ$</option>

                                        <option value="GMD" {{ old('currency', $project->currency) === 'GMD' ? 'selected' : '' }}>GMD -

                                            Gambian Dalasi - D</option>

                                        <option value="GEL" {{ old('currency', $project->currency) === 'GEL' ? 'selected' : '' }}>GEL -

                                            Georgian Lari - ლ</option>

                                        <option value="DEM" {{ old('currency', $project->currency) === 'DEM' ? 'selected' : '' }}>DEM -

                                            German Mark - DM</option>

                                        <option value="GHS" {{ old('currency', $project->currency) === 'GHS' ? 'selected' : '' }}>GHS -

                                            Ghanaian Cedi - GH₵</option>

                                        <option value="GIP" {{ old('currency', $project->currency) === 'GIP' ? 'selected' : '' }}>GIP -

                                            Gibraltar Pound - £</option>

                                        <option value="GRD" {{ old('currency', $project->currency) === 'GRD' ? 'selected' : '' }}>GRD -

                                            Greek Drachma - ₯, Δρχ, Δρ</option>

                                        <option value="GTQ" {{ old('currency', $project->currency) === 'GTQ' ? 'selected' : '' }}>GTQ -

                                            Guatemalan Quetzal - Q</option>

                                        <option value="GNF" {{ old('currency', $project->currency) === 'GNF' ? 'selected' : '' }}>GNF -

                                            Guinean Franc - FG</option>

                                        <option value="GYD" {{ old('currency', $project->currency) === 'GYD' ? 'selected' : '' }}>GYD -

                                            Guyanaese Dollar - $</option>

                                        <option value="HTG" {{ old('currency', $project->currency) === 'HTG' ? 'selected' : '' }}>HTG -

                                            Haitian Gourde - G</option>

                                        <option value="HNL" {{ old('currency', $project->currency) === 'HNL' ? 'selected' : '' }}>HNL -

                                            Honduran Lempira - L</option>

                                        <option value="HKD" {{ old('currency', $project->currency) === 'HKD' ? 'selected' : '' }}>HKD -

                                            Hong Kong Dollar - $</option>

                                        <option value="HUF" {{ old('currency', $project->currency) === 'HUF' ? 'selected' : '' }}>HUF -

                                            Hungarian Forint - Ft</option>

                                        <option value="ISK" {{ old('currency', $project->currency) === 'ISK' ? 'selected' : '' }}>ISK -

                                            Icelandic KrÃ³na - kr</option>

                                        <option value="INR" {{ old('currency', $project->currency) === 'INR' ? 'selected' : '' }}>INR -

                                            Indian Rupee - ₹</option>

                                        <option value="IDR" {{ old('currency', $project->currency) === 'IDR' ? 'selected' : '' }}>IDR -

                                            Indonesian Rupiah - Rp</option>

                                        <option value="IRR" {{ old('currency', $project->currency) === 'IRR' ? 'selected' : '' }}>IRR -

                                            Iranian Rial - ﷼</option>

                                        <option value="IQD" {{ old('currency', $project->currency) === 'IQD' ? 'selected' : '' }}>IQD -

                                            Iraqi Dinar - د.ع</option>

                                        <option value="ILS" {{ old('currency', $project->currency) === 'ILS' ? 'selected' : '' }}>ILS -

                                            Israeli New Sheqel - ₪</option>

                                        <option value="ITL" {{ old('currency', $project->currency) === 'ITL' ? 'selected' : '' }}>ITL -

                                            Italian Lira - L,£</option>

                                        <option value="JMD" {{ old('currency', $project->currency) === 'JMD' ? 'selected' : '' }}>JMD -

                                            Jamaican Dollar - J$</option>

                                        <option value="JPY" {{ old('currency', $project->currency) === 'JPY' ? 'selected' : '' }}>JPY -

                                            Japanese Yen - ¥</option>

                                        <option value="JOD" {{ old('currency', $project->currency) === 'JOD' ? 'selected' : '' }}>JOD -

                                            Jordanian Dinar - ا.د</option>

                                        <option value="KZT" {{ old('currency', $project->currency) === 'KZT' ? 'selected' : '' }}>KZT -

                                            Kazakhstani Tenge - лв</option>

                                        <option value="KES" {{ old('currency', $project->currency) === 'KES' ? 'selected' : '' }}>KES -

                                            Kenyan Shilling - KSh</option>

                                        <option value="KWD" {{ old('currency', $project->currency) === 'KWD' ? 'selected' : '' }}>KWD -

                                            Kuwaiti Dinar - ك.د</option>

                                        <option value="KGS" {{ old('currency', $project->currency) === 'KGS' ? 'selected' : '' }}>KGS -

                                            Kyrgystani Som - лв</option>

                                        <option value="LAK" {{ old('currency', $project->currency) === 'LAK' ? 'selected' : '' }}>LAK -

                                            Laotian Kip - ₭</option>

                                        <option value="LVL" {{ old('currency', $project->currency) === 'LVL' ? 'selected' : '' }}>LVL -

                                            Latvian Lats - Ls</option>

                                        <option value="LBP" {{ old('currency', $project->currency) === 'LBP' ? 'selected' : '' }}>LBP -

                                            Lebanese Pound - £</option>

                                        <option value="LSL" {{ old('currency', $project->currency) === 'LSL' ? 'selected' : '' }}>LSL -

                                            Lesotho Loti - L</option>

                                        <option value="LRD" {{ old('currency', $project->currency) === 'LRD' ? 'selected' : '' }}>LRD -

                                            Liberian Dollar - $</option>

                                        <option value="LYD" {{ old('currency', $project->currency) === 'LYD' ? 'selected' : '' }}>LYD -

                                            Libyan Dinar - د.ل</option>

                                        <option value="LTL" {{ old('currency', $project->currency) === 'LTL' ? 'selected' : '' }}>LTL -

                                            Lithuanian Litas - Lt</option>

                                        <option value="MOP" {{ old('currency', $project->currency) === 'MOP' ? 'selected' : '' }}>MOP -

                                            Macanese Pataca - $</option>

                                        <option value="MKD" {{ old('currency', $project->currency) === 'MKD' ? 'selected' : '' }}>MKD -

                                            Macedonian Denar - ден</option>

                                        <option value="MGA" {{ old('currency', $project->currency) === 'MGA' ? 'selected' : '' }}>MGA -

                                            Malagasy Ariary - Ar</option>

                                        <option value="MWK" {{ old('currency', $project->currency) === 'MWK' ? 'selected' : '' }}>MWK -

                                            Malawian Kwacha - MK</option>

                                        <option value="MYR" {{ old('currency', $project->currency) === 'MYR' ? 'selected' : '' }}>MYR

                                            - Malaysian Ringgit - RM</option>

                                        <option value="MVR" {{ old('currency', $project->currency) === 'MVR' ? 'selected' : '' }}>MVR

                                            - Maldivian Rufiyaa - Rf</option>

                                        <option value="MRO" {{ old('currency', $project->currency) === 'MRO' ? 'selected' : '' }}>MRO

                                            - Mauritanian Ouguiya - MRU</option>

                                        <option value="MUR" {{ old('currency', $project->currency) === 'MUR' ? 'selected' : '' }}>MUR

                                            - Mauritian Rupee - ₨</option>

                                        <option value="MXN" {{ old('currency', $project->currency) === 'MXN' ? 'selected' : '' }}>MXN

                                            - Mexican Peso - $</option>

                                        <option value="MDL" {{ old('currency', $project->currency) === 'MDL' ? 'selected' : '' }}>MDL

                                            - Moldovan Leu - L</option>

                                        <option value="MNT" {{ old('currency', $project->currency) === 'MNT' ? 'selected' : '' }}>MNT

                                            - Mongolian Tugrik - ₮</option>

                                        <option value="MAD" {{ old('currency', $project->currency) === 'MAD' ? 'selected' : '' }}>MAD

                                            - Moroccan Dirham - MAD</option>

                                        <option value="MZM" {{ old('currency', $project->currency) === 'MZM' ? 'selected' : '' }}>MZM

                                            - Mozambican Metical - MT</option>

                                        <option value="MMK" {{ old('currency', $project->currency) === 'MMK' ? 'selected' : '' }}>MMK

                                            - Myanmar Kyat - K</option>

                                        <option value="NAD" {{ old('currency', $project->currency) === 'NAD' ? 'selected' : '' }}>NAD

                                            - Namibian Dollar - $</option>

                                        <option value="NPR" {{ old('currency', $project->currency) === 'NPR' ? 'selected' : '' }}>NPR

                                            - Nepalese Rupee - ₨</option>

                                        <option value="ANG" {{ old('currency', $project->currency) === 'ANG' ? 'selected' : '' }}>ANG

                                            - Netherlands Antillean Guilder - ƒ</option>

                                        <option value="TWD" {{ old('currency', $project->currency) === 'TWD' ? 'selected' : '' }}>TWD

                                            - New Taiwan Dollar - $</option>

                                        <option value="NZD" {{ old('currency', $project->currency) === 'NZD' ? 'selected' : '' }}>NZD

                                            - New Zealand Dollar - $</option>

                                        <option value="NIO" {{ old('currency', $project->currency) === 'NIO' ? 'selected' : '' }}>NIO

                                            - Nicaraguan CÃ³rdoba - C$</option>

                                        <option value="NGN" {{ old('currency', $project->currency) === 'NGN' ? 'selected' : '' }}>NGN

                                            - Nigerian Naira - ₦</option>

                                        <option value="KPW" {{ old('currency', $project->currency) === 'KPW' ? 'selected' : '' }}>KPW

                                            - North Korean Won - ₩</option>

                                        <option value="NOK" {{ old('currency', $project->currency) === 'NOK' ? 'selected' : '' }}>NOK

                                            - Norwegian Krone - kr</option>

                                        <option value="OMR" {{ old('currency', $project->currency) === 'OMR' ? 'selected' : '' }}>OMR

                                            - Omani Rial - .ع.ر</option>

                                        <option value="PKR" {{ old('currency', $project->currency) === 'PKR' ? 'selected' : '' }}>PKR

                                            - Pakistani Rupee - ₨</option>

                                        <option value="PAB" {{ old('currency', $project->currency) === 'PAB' ? 'selected' : '' }}>PAB

                                            - Panamanian Balboa - B/.</option>

                                        <option value="PGK" {{ old('currency', $project->currency) === 'PGK' ? 'selected' : '' }}>PGK

                                            - Papua New Guinean Kina - K</option>

                                        <option value="PYG" {{ old('currency', $project->currency) === 'PYG' ? 'selected' : '' }}>PYG

                                            - Paraguayan Guarani - ₲</option>

                                        <option value="PEN" {{ old('currency', $project->currency) === 'PEN' ? 'selected' : '' }}>PEN

                                            - Peruvian Nuevo Sol - S/.</option>

                                        <option value="PHP" {{ old('currency', $project->currency) === 'PHP' ? 'selected' : '' }}>PHP

                                            - Philippine Peso - ₱</option>

                                        <option value="PLN" {{ old('currency', $project->currency) === 'PLN' ? 'selected' : '' }}>PLN

                                            - Polish Zloty - zł</option>

                                        <option value="QAR" {{ old('currency', $project->currency) === 'QAR' ? 'selected' : '' }}>QAR

                                            - Qatari Rial - ق.ر</option>

                                        <option value="RON" {{ old('currency', $project->currency) === 'RON' ? 'selected' : '' }}>RON

                                            - Romanian Leu - lei</option>

                                        <option value="RUB" {{ old('currency', $project->currency) === 'RUB' ? 'selected' : '' }}>RUB

                                            - Russian Ruble - ₽</option>

                                        <option value="RWF" {{ old('currency', $project->currency) === 'RWF' ? 'selected' : '' }}>RWF

                                            - Rwandan Franc - FRw</option>

                                        <option value="SVC" {{ old('currency', $project->currency) === 'SVC' ? 'selected' : '' }}>SVC

                                            - Salvadoran ColÃ³n - ₡</option>

                                        <option value="WST" {{ old('currency', $project->currency) === 'WST' ? 'selected' : '' }}>WST

                                            - Samoan Tala - SAT</option>

                                        <option value="SAR" {{ old('currency', $project->currency) === 'SAR' ? 'selected' : '' }}>SAR

                                            - Saudi Riyal - ﷼</option>

                                        <option value="RSD" {{ old('currency', $project->currency) === 'RSD' ? 'selected' : '' }}>RSD

                                            - Serbian Dinar - din</option>

                                        <option value="SCR" {{ old('currency', $project->currency) === 'SCR' ? 'selected' : '' }}>SCR

                                            - Seychellois Rupee - SRe</option>

                                        <option value="SLL" {{ old('currency', $project->currency) === 'SLL' ? 'selected' : '' }}>SLL

                                            - Sierra Leonean Leone - Le</option>

                                        <option value="SGD" {{ old('currency', $project->currency) === 'SGD' ? 'selected' : '' }}>SGD

                                            - Singapore Dollar - $</option>

                                        <option value="SKK" {{ old('currency', $project->currency) === 'SKK' ? 'selected' : '' }}>SKK

                                            - Slovak Koruna - Sk</option>

                                        <option value="SBD" {{ old('currency', $project->currency) === 'SBD' ? 'selected' : '' }}>SBD

                                            - Solomon Islands Dollar - Si$</option>

                                        <option value="SOS" {{ old('currency', $project->currency) === 'SOS' ? 'selected' : '' }}>SOS

                                            - Somali Shilling - Sh.so.</option>

                                        <option value="ZAR" {{ old('currency', $project->currency) === 'ZAR' ? 'selected' : '' }}>ZAR

                                            - South African Rand - R</option>

                                        <option value="KRW" {{ old('currency', $project->currency) === 'KRW' ? 'selected' : '' }}>KRW

                                            - South Korean Won - ₩</option>

                                        <option value="XDR" {{ old('currency', $project->currency) === 'XDR' ? 'selected' : '' }}>XDR

                                            - Special Drawing Rights - SDR</option>

                                        <option value="LKR" {{ old('currency', $project->currency) === 'LKR' ? 'selected' : '' }}>LKR

                                            - Sri Lankan Rupee - Rs</option>

                                        <option value="SHP" {{ old('currency', $project->currency) === 'SHP' ? 'selected' : '' }}>SHP

                                            - St. Helena Pound - £</option>

                                        <option value="SDG" {{ old('currency', $project->currency) === 'SDG' ? 'selected' : '' }}>SDG

                                            - Sudanese Pound - .س.ج</option>

                                        <option value="SRD" {{ old('currency', $project->currency) === 'SRD' ? 'selected' : '' }}>SRD

                                            - Surinamese Dollar - $</option>

                                        <option value="SZL" {{ old('currency', $project->currency) === 'SZL' ? 'selected' : '' }}>SZL

                                            - Swazi Lilangeni - E</option>

                                        <option value="SEK" {{ old('currency', $project->currency) === 'SEK' ? 'selected' : '' }}>SEK

                                            - Swedish Krona - kr</option>

                                        <option value="CHF" {{ old('currency', $project->currency) === 'CHF' ? 'selected' : '' }}>CHF

                                            - Swiss Franc - CHf</option>

                                        <option value="SYP" {{ old('currency', $project->currency) === 'SYP' ? 'selected' : '' }}>SYP

                                            - Syrian Pound - LS</option>

                                        <option value="STD" {{ old('currency', $project->currency) === 'STD' ? 'selected' : '' }}>STD

                                            - São Tomé and Príncipe Dobra - Db</option>

                                        <option value="TJS" {{ old('currency', $project->currency) === 'TJS' ? 'selected' : '' }}>TJS

                                            - Tajikistani Somoni - SM</option>

                                        <option value="TZS" {{ old('currency', $project->currency) === 'TZS' ? 'selected' : '' }}>TZS

                                            - Tanzanian Shilling - TSh</option>

                                        <option value="THB" {{ old('currency', $project->currency) === 'THB' ? 'selected' : '' }}>THB

                                            - Thai Baht - ฿</option>

                                        <option value="TOP" {{ old('currency', $project->currency) === 'TOP' ? 'selected' : '' }}>TOP

                                            - Tongan pa'anga - $</option>

                                        <option value="TTD" {{ old('currency', $project->currency) === 'TTD' ? 'selected' : '' }}>TTD

                                            - Trinidad & Tobago Dollar - $</option>

                                        <option value="TND" {{ old('currency', $project->currency) === 'TND' ? 'selected' : '' }}>TND

                                            - Tunisian Dinar - ت.د</option>

                                        <option value="TRY" {{ old('currency', $project->currency) === 'TRY' ? 'selected' : '' }}>TRY

                                            - Turkish Lira - ₺</option>

                                        <option value="TMT" {{ old('currency', $project->currency) === 'TMT' ? 'selected' : '' }}>TMT

                                            - Turkmenistani Manat - T</option>

                                        <option value="UGX" {{ old('currency', $project->currency) === 'UGX' ? 'selected' : '' }}>UGX

                                            - Ugandan Shilling - USh</option>

                                        <option value="UAH" {{ old('currency', $project->currency) === 'UAH' ? 'selected' : '' }}>UAH

                                            - Ukrainian Hryvnia - ₴</option>

                                        <option value="AED" {{ old('currency', $project->currency) === 'AED' ? 'selected' : '' }}>AED

                                            - United Arab Emirates Dirham - إ.د</option>

                                        <option value="UYU" {{ old('currency', $project->currency) === 'UYU' ? 'selected' : '' }}>UYU

                                            - Uruguayan Peso - $</option>

                                        <option value="USD" {{ old('currency', $project->currency) === 'USD' ? 'selected' : '' }}>USD

                                            - US Dollar - $</option>

                                        <option value="UZS" {{ old('currency', $project->currency) === 'UZS' ? 'selected' : '' }}>UZS

                                            - Uzbekistan Som - лв</option>

                                        <option value="VUV" {{ old('currency', $project->currency) === 'VUV' ? 'selected' : '' }}>VUV

                                            - Vanuatu Vatu - VT</option>

                                        <option value="VEF" {{ old('currency', $project->currency) === 'VEF' ? 'selected' : '' }}>VEF

                                            - Venezuelan BolÃ­var - Bs</option>

                                        <option value="VND" {{ old('currency', $project->currency) === 'VND' ? 'selected' : '' }}>VND

                                            - Vietnamese Dong - ₫</option>

                                        <option value="YER" {{ old('currency', $project->currency) === 'YER' ? 'selected' : '' }}>YER

                                            - Yemeni Rial - ﷼</option>

                                        <option value="ZMK" {{ old('currency', $project->currency) === 'ZMK' ? 'selected' : '' }}>ZMK

                                            - Zambian Kwacha - ZK</option>

                                    </select>

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Budget</label>

                                    <input type="number" name="projectbudget" class="form-control" placeholder="Project Budget" value="{{ old('projectbudget', $project->projectbudget) }}">

                                    @error('projectbudget')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">CSM</label>

                                    <select id="inputState" class="form-select" name="csm">

                                        <option value="">Select CSM</option>

                                        <option value="Aman Mishra" {{ $project && $project->csm == 'Aman Mishra' ? 'selected' : '' }}>

                                            Aman Mishra</option>

                                        <option value="Anup Kumar" {{ $project && $project->csm == 'Anup Kumar' ? 'selected' : '' }}>

                                            Anup Kumar</option>

                                        <option value="Sumit Dhiman" {{ $project && $project->csm == 'Sumit Dhiman' ? 'selected' : '' }}>

                                            Sumit Dhiman</option>

                                    </select>

                                    @error('csm')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Tags</label>

                                    <input type="text" class="form-control" id="inputZip" name="tags" placeholder="Tags" value="{{ old('tags', $project->tags ?? '') }}">

                                    @error('tags')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Start Date</label>

                                    <input type="date" class="form-control" name="projectstartdate" id="inputZip" placeholder="ProjectStartDate" value="{{ old('projectstartdate', $project->projectstartdate) }}">

                                    @error('projectstartdate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">End Date</label>

                                    <input type="date" class="form-control" name="projectenddate" id="inputZip" placeholder="ProjectEndDate" value="{{ old('projectenddate', $project->projectenddate) }}">

                                    @error('projectenddate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Service Type</label>

                                    <select id="inputState" class="form-select" name="sc">

                                        <option value="">Select Service Type</option>

                                        <option value="mannage Service" {{ $project && $project->sc == 'mannage Service' ? 'selected' : '' }}>

                                            Mannage Service</option>

                                        <option value="Time &Metrial" {{ $project && $project->sc == 'Time &Metrial' ? 'selected' : '' }}>

                                            Time & Metrial</option>

                                        <option value="Support Maintance" {{ $project && $project->sc == 'Support Maintance' ? 'selected' : '' }}>

                                            Support Maintance</option>

                                    </select>

                                    @error('csm')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Project Status</label>

                                    <select id="inputState" class="form-select" name="status">

                                        <option value="">Select Status</option>

                                        <option value="Active" {{ $project->status == 'Active' ? 'selected' : '' }}>

                                            Active</option>

                                        <option value="InActive" {{ $project->status == 'InActive' ? 'selected' : '' }}>

                                            Inactive</option>

                                        <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>

                                    </select>

                                    @error('status')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="inputState">Project Manager</label>
                                    <select id="pmEmployeeName" class="form-select @error('pmEmployeeName') is-invalid @enderror" name="pmEmployeeName">
                                        <option value="">Select Project Manager</option>
                                        @foreach ($projectManagers as $manager)
                                        @if ($manager['userDesignation'] === 'Project Manager')
                                        <option value="{{ $manager['employee_Id'] }}">{{ $manager['name'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('pmEmployeeName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label">Project Allocation</label>
                                    <input type="number" class="form-control @error('pmallocation') is-invalid @enderror" name="pmallocation" id="pmallocation" placeholder="Project Manager Allocation">
                                    @error('pmallocation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="allocation-error" class="alert alert-danger" style="display: none;"></div>
                                </div> -->
                                <!-- <div class="col-md-6">
                                    <label for="inputState">Project Manager</label>
                                    <select id="pmEmployeeName" class="form-select @error('pmEmployeeName') is-invalid @enderror" name="pmEmployeeName">
                                        <option value="">Select Project Manager</option>
                                        @foreach ($projectManagers as $manager)
                                        <option value="{{ $manager['employee_Id'] }}" {{ $manager['employee_Id'] == $project->pmemployeeId ? 'selected' : '' }}>
                                            {{ $manager['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pmEmployeeName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label">Project Allocation</label>
                                    <input type="number" class="form-control @error('pmallocation') is-invalid @enderror" name="pmallocation" id="pmallocation" placeholder="Project Manager Allocation" value="{{ $project->pmallocation }}">
                                    @error('pmallocation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="allocation-error" class="alert alert-danger" style="display: none;"></div>
                                </div> -->
                                <div class="col-md-6">
                <label for="inputState">Project Manager</label>
                <select id="pmEmployeeName" class="form-select @error('pmEmployeeName') is-invalid @enderror" name="pmEmployeeName">
                    <option value="">Select Project Manager</option>
                    @foreach ($projectManagers as $manager)
                        <option value="{{ $manager['id'] }}" {{ $manager['id'] == $project->pmemployeeId ? 'selected' : '' }}>
                            {{ $manager['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('pmEmployeeName')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputZip" class="form-label">Project Allocation</label>
                <input type="number" class="form-control @error('pmallocation') is-invalid @enderror" name="pmallocation" id="pmallocation" placeholder="Project Manager Allocation" value="{{ $project->pmallocation }}">
                @error('pmallocation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="allocation-error" class="alert alert-danger" style="display: none;"></div>
            </div>





                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Type</label>

                                    <select multiple class="chosen-select" name="projecttype[]">

                                        <option value="Web" {{ in_array('Web', old('projecttype', isset($project) ? json_decode($project->projecttype) : []))

                                                    ? 'selected'

                                                    : '' }}>

                                            Web</option>

                                        <option value="Andriod" {{ in_array('Andriod', old('projecttype', isset($project) ? json_decode($project->projecttype) : []))

                                                    ? 'selected'

                                                    : '' }}>

                                            Andriod</option>

                                        <option value="Ios" {{ in_array('Ios', old('projecttype', isset($project) ? json_decode($project->projecttype) : []))

                                                    ? 'selected'

                                                    : '' }}>

                                            Ios</option>

                                    </select>

                                    @error('projecttype')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                            </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row layout-top-spacing">

            <div id="flLoginForm" class="col-lg-12 layout-spacing">

                <div class="statbox widget box box-shadow">

                    <div class="widget-header">

                        <div class="row">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                <h4>Client Detail</h4>

                            </div>

                        </div>

                    </div>

                    <input type="hidden" name="projectId" value="{{ $project->id }}" <div class="widget-content widget-content-area">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label for="inputZip" class="form-label">Client Name</label>

                            <input type="text" class="form-control" name="cilentname" id="inputZip" placeholder="Client Name" value="{{ old('cilentname', $project->cilentname) }}">

                            @error('cilentname')

                            <div class="alert alert-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label for="inputZip" class="form-label">Client Email</label>



                            <input type="email" class="form-control" name="cilentemail" id="inputZip" placeholder="Client Email" value="{{ old('cilentemail', $project->cilentemail) }}">

                            @error('cilentemail')

                            <div class="alert alert-danger">{{ $message }}</div>

                            @enderror

                        </div>



                        <div class="col-md-6">

                            <label for="inputZip" class="form-label">Company Name</label>



                            <input type="text" class="form-control" name="companyname" id="inputZip" placeholder="Company Name" value="{{ old('companyname', $project->companyname) }}">

                            @error('companyname')

                            <div class="alert alert-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label for="inputZip" class="form-label">Client Phone</label>



                            <input type="number" class="form-control" name="cilentphone" id="inputZip" placeholder="Client Phone" value="{{ old('cilentphone', $project->cilentphone) }}">



                            @error('cilentphone')

                            <div class="alert alert-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="text">Country</label>

                                <select id="inputState" class="form-select" name="country">

                                    <option value="" {{ old('country', $project->country) === '' ? 'selected' : '' }}>Select

                                        Country</option>

                                    <option value="United States" {{ old('country', $project->country) ===

                                            'United

                                                                                                                                States'

                                                ? 'selected'

                                                : '' }}>

                                        United States</option>

                                    <option value="Afghanistan" {{ old('country', $project->country) === 'Afghanistan' ? 'selected' : '' }}>

                                        Afghanistan</option>

                                    <option value="Albania" {{ old('country', $project->country) === 'Albania' ? 'selected' : '' }}>

                                        Albania</option>

                                    <option value="Algeria" {{ old('country', $project->country) === 'Algeria' ? 'selected' : '' }}>

                                        Algeria</option>

                                    <option value="American Samoa" {{ old('country', $project->country) ===

                                            'American

                                                                                                                                Samoa'

                                                ? 'selected'

                                                : '' }}>

                                        American Samoa</option>

                                    <option value="Andorra" {{ old('country', $project->country) === 'Andorra' ? 'selected' : '' }}>

                                        Andorra</option>

                                    <option value="Angola" {{ old('country', $project->country) === 'Angola' ? 'selected' : '' }}>

                                        Angola</option>

                                    <option value="Anguilla" {{ old('country', $project->country) === 'Anguilla' ? 'selected' : '' }}>

                                        Anguilla</option>

                                    <option value="Antarctica" {{ old('country', $project->country) === 'Antarctica' ? 'selected' : '' }}>

                                        Antarctica</option>

                                    <option value="Antigua and Barbuda" {{ old('country', $project->country) === 'Antigua and Barbuda' ? 'selected' : '' }}>

                                        Antigua and Barbuda</option>

                                    <option value="Argentina" {{ old('country', $project->country) === 'Argentina' ? 'selected' : '' }}>

                                        Argentina</option>

                                    <option value="Armenia" {{ old('country', $project->country) === 'Armenia' ? 'selected' : '' }}>

                                        Armenia</option>

                                    <option value="Aruba" {{ old('country', $project->country) === 'Aruba' ? 'selected' : '' }}>

                                        Aruba</option>

                                    <option value="Australia" {{ old('country', $project->country) === 'Australia' ? 'selected' : '' }}>

                                        Australia</option>

                                    <option value="Austria" {{ old('country', $project->country) === 'Austria' ? 'selected' : '' }}>

                                        Austria</option>

                                    <option value="Azerbaijan" {{ old('country', $project->country) === 'Azerbaijan' ? 'selected' : '' }}>

                                        Azerbaijan</option>

                                    <option value="Bahamas" {{ old('country', $project->country) === 'Bahamas' ? 'selected' : '' }}>

                                        Bahamas</option>

                                    <option value="Bahrain" {{ old('country', $project->country) === 'Bahrain' ? 'selected' : '' }}>

                                        Bahrain</option>

                                    <option value="Bangladesh" {{ old('country', $project->country) === 'Bangladesh' ? 'selected' : '' }}>

                                        Bangladesh</option>

                                    <option value="Barbados" {{ old('country', $project->country) === 'Barbados' ? 'selected' : '' }}>

                                        Barbados</option>

                                    <option value="Belarus" {{ old('country', $project->country) === 'Belarus' ? 'selected' : '' }}>

                                        Belarus</option>

                                    <option value="Belgium" {{ old('country', $project->country) === 'Belgium' ? 'selected' : '' }}>

                                        Belgium</option>

                                    <option value="Belize" {{ old('country', $project->country) === 'Belize' ? 'selected' : '' }}>

                                        Belize</option>

                                    <option value="Benin" {{ old('country', $project->country) === 'Benin' ? 'selected' : '' }}>

                                        Benin</option>

                                    <option value="Bermuda" {{ old('country', $project->country) === 'Bermuda' ? 'selected' : '' }}>

                                        Bermuda</option>

                                    <option value="Bhutan" {{ old('country', $project->country) === 'Bhutan' ? 'selected' : '' }}>

                                        Bhutan</option>

                                    <option value="Bolivia" {{ old('country', $project->country) === 'Bolivia' ? 'selected' : '' }}>

                                        Bolivia</option>

                                    <option value="Bosnia and Herzegowina" {{ old('country', $project->country) === 'Bosnia and Herzegowina' ? 'selected' : '' }}>

                                        Bosnia and Herzegowina</option>

                                    <option value="Botswana" {{ old('country', $project->country) === 'Botswana' ? 'selected' : '' }}>

                                        Botswana</option>

                                    <option value="Bouvet Island" {{ old('country', $project->country) ===

                                            'Bouvet

                                                                                                                                Island'

                                                ? 'selected'

                                                : '' }}>

                                        Bouvet Island</option>

                                    <option value="Brazil" {{ old('country', $project->country) === 'Brazil' ? 'selected' : '' }}>

                                        Brazil</option>

                                    <option value="British Indian Ocean Territory" {{ old('country', $project->country) === 'British Indian Ocean Territory' ? 'selected' : '' }}>

                                        British Indian Ocean

                                        Territory</option>

                                    <option value="Brunei Darussalam" {{ old('country', $project->country) ===

                                            'Brunei

                                                                                                                                Darussalam'

                                                ? 'selected'

                                                : '' }}>

                                        Brunei Darussalam</option>

                                    <option value="Bulgaria" {{ old('country', $project->country) === 'Bulgaria' ? 'selected' : '' }}>

                                        Bulgaria</option>

                                    <option value="Burkina Faso" {{ old('country', $project->country) === 'Burkina Faso' ? 'selected' : '' }}>

                                        Burkina Faso</option>

                                    <option value="Burundi" {{ old('country', $project->country) === 'Burundi' ? 'selected' : '' }}>

                                        Burundi</option>

                                    <option value="Cambodia" {{ old('country', $project->country) === 'Cambodia' ? 'selected' : '' }}>

                                        Cambodia</option>

                                    <option value="Cameroon" {{ old('country', $project->country) === 'Cameroon' ? 'selected' : '' }}>

                                        Cameroon</option>

                                    <option value="Canada" {{ old('country', $project->country) === 'Canada' ? 'selected' : '' }}>

                                        Canada</option>

                                    <option value="Cape Verde" {{ old('country', $project->country) === 'Cape Verde' ? 'selected' : '' }}>

                                        Cape Verde</option>

                                    <option value="Cayman Islands" {{ old('country', $project->country) ===

                                            'Cayman

                                                                                                                                Islands'

                                                ? 'selected'

                                                : '' }}>

                                        Cayman Islands</option>

                                    <option value="Central African Republic" {{ old('country', $project->country) === 'Central African Republic' ? 'selected' : '' }}>

                                        Central African Republic

                                    </option>

                                    <option value="Chad" {{ old('country', $project->country) === 'Chad' ? 'selected' : '' }}>

                                        Chad</option>

                                    <option value="Chile" {{ old('country', $project->country) === 'Chile' ? 'selected' : '' }}>

                                        Chile</option>

                                    <option value="China" {{ old('country', $project->country) === 'China' ? 'selected' : '' }}>

                                        China</option>

                                    <option value="Christmas Island" {{ old('country', $project->country) ===

                                            'Christmas

                                                                                                                                Island'

                                                ? 'selected'

                                                : '' }}>

                                        Christmas Island</option>

                                    <option value="Cocos (Keeling) Islands" {{ old('country', $project->country) === 'Cocos (Keeling) Islands' ? 'selected' : '' }}>

                                        Cocos (Keeling) Islands</option>

                                    <option value="Colombia" {{ old('country', $project->country) === 'Colombia' ? 'selected' : '' }}>

                                        Colombia</option>

                                    <option value="Comoros" {{ old('country', $project->country) === 'Comoros' ? 'selected' : '' }}>

                                        Comoros</option>

                                    <option value="Congo" {{ old('country', $project->country) === 'Congo' ? 'selected' : '' }}>

                                        Congo</option>

                                    <option value="Congo, the Democratic Republic of the" {{ old('country', $project->country) === 'Congo, the Democratic Republic of the' ? 'selected' : '' }}>

                                        Congo,

                                        the Democratic Republic of the</option>

                                    <option value="Cook Islands" {{ old('country', $project->country) === 'Cook Islands' ? 'selected' : '' }}>

                                        Cook Islands</option>

                                    <option value="Costa Rica" {{ old('country', $project->country) === 'Costa Rica' ? 'selected' : '' }}>

                                        Costa Rica</option>

                                    <option value="Cote dIvoire" {{ old('country', $project->country) === 'Cote dIvoire' ? 'selected' : '' }}>

                                        Cote d'Ivoire</option>

                                    <option value="Croatia (Hrvatska)" {{ old('country', $project->country) ===

                                            'Croatia

                                                                                                                                (Hrvatska)'

                                                ? 'selected'

                                                : '' }}>

                                        Croatia (Hrvatska)</option>

                                    <option value="Cuba" {{ old('country', $project->country) === 'Cuba' ? 'selected' : '' }}>

                                        Cuba</option>

                                    <option value="Cyprus" {{ old('country', $project->country) === 'Cyprus' ? 'selected' : '' }}>

                                        Cyprus</option>

                                    <option value="Czech Republic" {{ old('country', $project->country) ===

                                            'Czech

                                                                                                                                Republic'

                                                ? 'selected'

                                                : '' }}>

                                        Czech Republic</option>

                                    <option value="Denmark" {{ old('country', $project->country) === 'Denmark' ? 'selected' : '' }}>

                                        Denmark</option>

                                    <option value="Djibouti" {{ old('country', $project->country) === 'Djibouti' ? 'selected' : '' }}>

                                        Djibouti</option>

                                    <option value="Dominica" {{ old('country', $project->country) === 'Dominica' ? 'selected' : '' }}>

                                        Dominica</option>

                                    <option value="Dominican Republic" {{ old('country', $project->country) === 'Dominican Republic' ? 'selected' : '' }}>

                                        Dominican Republic</option>

                                    <option value="East Timor" {{ old('country', $project->country) === 'East Timor' ? 'selected' : '' }}>

                                        East Timor</option>

                                    <option value="Ecuador" {{ old('country', $project->country) === 'Ecuador' ? 'selected' : '' }}>

                                        Ecuador</option>

                                    <option value="Egypt" {{ old('country', $project->country) === 'Egypt' ? 'selected' : '' }}>

                                        Egypt</option>

                                    <option value="El Salvador" {{ old('country', $project->country) === 'El Salvador' ? 'selected' : '' }}>

                                        El Salvador</option>

                                    <option value="Equatorial Guinea" {{ old('country', $project->country) === 'Equatorial Guinea' ? 'selected' : '' }}>

                                        Equatorial Guinea</option>

                                    <option value="Eritrea" {{ old('country', $project->country) === 'Eritrea' ? 'selected' : '' }}>

                                        Eritrea</option>

                                    <option value="Estonia" {{ old('country', $project->country) === 'Estonia' ? 'selected' : '' }}>

                                        Estonia</option>

                                    <option value="Ethiopia" {{ old('country', $project->country) === 'Ethiopia' ? 'selected' : '' }}>

                                        Ethiopia</option>

                                    <option value="Falkland Islands (Malvinas)" {{ old('country', $project->country) === 'Falkland Islands (Malvinas)' ? 'selected' : '' }}>

                                        Falkland Islands (Malvinas)

                                    </option>

                                    <option value="Faroe Islands" {{ old('country', $project->country) ===

                                            'Faroe

                                                                                                                                Islands'

                                                ? 'selected'

                                                : '' }}>

                                        Faroe Islands</option>

                                    <option value="Fiji" {{ old('country', $project->country) === 'Fiji' ? 'selected' : '' }}>

                                        Fiji</option>

                                    <option value="Finland" {{ old('country', $project->country) === 'Finland' ? 'selected' : '' }}>

                                        Finland</option>

                                    <option value="France" {{ old('country', $project->country) === 'France' ? 'selected' : '' }}>

                                        France</option>

                                    <option value="France Metropolitan" {{ old('country', $project->country) ===

                                            'France

                                                                                                                                Metropolitan'

                                                ? 'selected'

                                                : '' }}>

                                        France Metropolitan</option>

                                    <option value="French Guiana" {{ old('country', $project->country) ===

                                            'French

                                                                                                                                Guiana'

                                                ? 'selected'

                                                : '' }}>

                                        French Guiana</option>

                                    <option value="French Polynesia" {{ old('country', $project->country) ===

                                            'French

                                                                                                                                Polynesia'

                                                ? 'selected'

                                                : '' }}>

                                        French Polynesia</option>

                                    <option value="French Southern Territories" {{ old('country', $project->country) === 'French Southern Territories' ? 'selected' : '' }}>

                                        French Southern Territories

                                    </option>

                                    <option value="Gabon" {{ old('country', $project->country) === 'Gabon' ? 'selected' : '' }}>

                                        Gabon</option>

                                    <option value="Gambia" {{ old('country', $project->country) === 'Gambia' ? 'selected' : '' }}>

                                        Gambia</option>

                                    <option value="Georgia" {{ old('country', $project->country) === 'Georgia' ? 'selected' : '' }}>

                                        Georgia</option>

                                    <option value="Germany" {{ old('country', $project->country) === 'Germany' ? 'selected' : '' }}>

                                        Germany</option>

                                    <option value="Ghana" {{ old('country', $project->country) === 'Ghana' ? 'selected' : '' }}>

                                        Ghana</option>

                                    <option value="Gibraltar" {{ old('country', $project->country) === 'Gibraltar' ? 'selected' : '' }}>

                                        Gibraltar</option>

                                    <option value="Greece" {{ old('country', $project->country) === 'Greece' ? 'selected' : '' }}>

                                        Greece</option>

                                    <option value="Greenland" {{ old('country', $project->country) === 'Greenland' ? 'selected' : '' }}>

                                        Greenland</option>

                                    <option value="Grenada" {{ old('country', $project->country) === 'Grenada' ? 'selected' : '' }}>

                                        Grenada</option>

                                    <option value="Guadeloupe" {{ old('country', $project->country) === 'Guadeloupe' ? 'selected' : '' }}>

                                        Guadeloupe</option>

                                    <option value="Guam" {{ old('country', $project->country) === 'Guam' ? 'selected' : '' }}>

                                        Guam</option>

                                    <option value="Guatemala" {{ old('country', $project->country) === 'Guatemala' ? 'selected' : '' }}>

                                        Guatemala</option>

                                    <option value="Guinea" {{ old('country', $project->country) === 'Guinea' ? 'selected' : '' }}>

                                        Guinea</option>

                                    <option value="Guinea-Bissau" {{ old('country', $project->country) === 'Guinea-Bissau' ? 'selected' : '' }}>

                                        Guinea-Bissau</option>

                                    <option value="Guyana" {{ old('country', $project->country) === 'Guyana' ? 'selected' : '' }}>

                                        Guyana</option>

                                    <option value="Haiti" {{ old('country', $project->country) === 'Haiti' ? 'selected' : '' }}>

                                        Haiti</option>

                                    <option value="Heard and Mc Donald Islands" {{ old('country', $project->country) === 'Heard and Mc Donald Islands' ? 'selected' : '' }}>

                                        Heard and Mc Donald Islands

                                    </option>

                                    <option value="Holy See (Vatican City State)" {{ old('country', $project->country) === 'Holy See (Vatican City State)' ? 'selected' : '' }}>

                                        Holy See (Vatican City

                                        State)</option>

                                    <option value="Honduras" {{ old('country', $project->country) === 'Honduras' ? 'selected' : '' }}>

                                        Honduras</option>

                                    <option value="Hong Kong" {{ old('country', $project->country) === 'Hong Kong' ? 'selected' : '' }}>

                                        Hong Kong</option>

                                    <option value="Hungary" {{ old('country', $project->country) === 'Hungary' ? 'selected' : '' }}>

                                        Hungary</option>

                                    <option value="Iceland" {{ old('country', $project->country) === 'Iceland' ? 'selected' : '' }}>

                                        Iceland</option>

                                    <option value="India" {{ old('country', $project->country) === 'India' ? 'selected' : '' }}>

                                        India</option>

                                    <option value="Indonesia" {{ old('country', $project->country) === 'Indonesia' ? 'selected' : '' }}>

                                        Indonesia</option>

                                    <option value="Iran (Islamic Republic of)" {{ old('country', $project->country) === 'Iran (Islamic Republic of)' ? 'selected' : '' }}>

                                        Iran (Islamic Republic of)

                                    </option>

                                    <option value="Iraq" {{ old('country', $project->country) === 'Iraq' ? 'selected' : '' }}>

                                        Iraq</option>

                                    <option value="Ireland" {{ old('country', $project->country) === 'Ireland' ? 'selected' : '' }}>

                                        Ireland</option>

                                    <option value="Israel" {{ old('country', $project->country) === 'Israel' ? 'selected' : '' }}>

                                        Israel</option>

                                    <option value="Italy" {{ old('country', $project->country) === 'Italy' ? 'selected' : '' }}>

                                        Italy</option>

                                    <option value="Jamaica" {{ old('country', $project->country) === 'Jamaica' ? 'selected' : '' }}>

                                        Jamaica</option>

                                    <option value="Japan" {{ old('country', $project->country) === 'Japan' ? 'selected' : '' }}>

                                        Japan</option>

                                    <option value="Jordan" {{ old('country', $project->country) === 'Jordan' ? 'selected' : '' }}>

                                        Jordan</option>

                                    <option value="Kazakhstan" {{ old('country', $project->country) === 'Kazakhstan' ? 'selected' : '' }}>

                                        Kazakhstan</option>

                                    <option value="Kenya" {{ old('country', $project->country) === 'Kenya' ? 'selected' : '' }}>

                                        Kenya</option>

                                    <option value="Kiribati" {{ old('country', $project->country) === 'Kiribati' ? 'selected' : '' }}>

                                        Kiribati</option>

                                    <option value="Korea, Democratic People's Republic of" {{ old('country', $project->country) === 'Korea, Democratic People\'s Republic of' ? 'selected' : '' }}>

                                        Korea, Democratic People's Republic of</option>

                                    <option value="Micronesia, Federated States of" {{ old('country', $project->country) === 'Micronesia, Federated States of' ? 'selected' : '' }}>

                                        Micronesia, Federated

                                        States of</option>

                                    <option value="Moldova, Republic of" {{ old('country', $project->country) === 'Moldova, Republic of' ? 'selected' : '' }}>

                                        Moldova, Republic of</option>

                                    <option value="Monaco" {{ old('country', $project->country) === 'Monaco' ? 'selected' : '' }}>

                                        Monaco</option>

                                    <option value="Mongolia" {{ old('country', $project->country) === 'Mongolia' ? 'selected' : '' }}>

                                        Mongolia</option>

                                    <option value="Montserrat" {{ old('country', $project->country) === 'Montserrat' ? 'selected' : '' }}>

                                        Montserrat</option>

                                    <option value="Morocco" {{ old('country', $project->country) === 'Morocco' ? 'selected' : '' }}>

                                        Morocco</option>

                                    <option value="Mozambique" {{ old('country', $project->country) === 'Mozambique' ? 'selected' : '' }}>

                                        Mozambique</option>

                                    <option value="Myanmar" {{ old('country', $project->country) === 'Myanmar' ? 'selected' : '' }}>

                                        Myanmar</option>

                                    <option value="Namibia" {{ old('country', $project->country) === 'Namibia' ? 'selected' : '' }}>

                                        Namibia</option>

                                    <option value="Nauru" {{ old('country', $project->country) === 'Nauru' ? 'selected' : '' }}>

                                        Nauru</option>

                                    <option value="Nepal" {{ old('country', $project->country) === 'Nepal' ? 'selected' : '' }}>

                                        Nepal</option>

                                    <option value="Netherlands" {{ old('country', $project->country) === 'Netherlands' ? 'selected' : '' }}>

                                        Netherlands</option>

                                    <option value="Netherlands Antilles" {{ old('country', $project->country) === 'Netherlands Antilles' ? 'selected' : '' }}>

                                        Netherlands Antilles</option>

                                    <option value="New Caledonia" {{ old('country', $project->country) ===

                                            'New

                                                                                                                                Caledonia'

                                                ? 'selected'

                                                : '' }}>

                                        New Caledonia</option>

                                    <option value="New Zealand" {{ old('country', $project->country) === 'New Zealand' ? 'selected' : '' }}>

                                        New Zealand</option>

                                    <option value="Nicaragua" {{ old('country', $project->country) === 'Nicaragua' ? 'selected' : '' }}>

                                        Nicaragua</option>

                                    <option value="Niger" {{ old('country', $project->country) === 'Niger' ? 'selected' : '' }}>

                                        Niger</option>

                                    <option value="Nigeria" {{ old('country', $project->country) === 'Nigeria' ? 'selected' : '' }}>

                                        Nigeria</option>

                                    <option value="Niue" {{ old('country', $project->country) === 'Niue' ? 'selected' : '' }}>

                                        Niue</option>

                                    <option value="Norfolk Island" {{ old('country', $project->country) ===

                                            'Norfolk

                                                                                                                                Island'

                                                ? 'selected'

                                                : '' }}>

                                        Norfolk Island</option>

                                    <option value="Northern Mariana Islands" {{ old('country', $project->country) === 'Northern Mariana Islands' ? 'selected' : '' }}>

                                        Northern Mariana Islands

                                    </option>

                                    <option value="Norway" {{ old('country', $project->country) === 'Norway' ? 'selected' : '' }}>

                                        Norway</option>

                                    <option value="Oman" {{ old('country', $project->country) === 'Oman' ? 'selected' : '' }}>

                                        Oman</option>

                                    <option value="Pakistan" {{ old('country', $project->country) === 'Pakistan' ? 'selected' : '' }}>

                                        Pakistan</option>

                                    <option value="Palau" {{ old('country', $project->country) === 'Palau' ? 'selected' : '' }}>

                                        Palau</option>

                                    <option value="Panama" {{ old('country', $project->country) === 'Panama' ? 'selected' : '' }}>

                                        Panama</option>

                                    <option value="Papua New Guinea" {{ old('country', $project->country) ===

                                            'Papua New

                                                                                                                                Guinea'

                                                ? 'selected'

                                                : '' }}>

                                        Papua New Guinea</option>

                                    <option value="Paraguay" {{ old('country', $project->country) === 'Paraguay' ? 'selected' : '' }}>

                                        Paraguay</option>

                                    <option value="Peru" {{ old('country', $project->country) === 'Peru' ? 'selected' : '' }}>

                                        Peru</option>

                                    <option value="Philippines" {{ old('country', $project->country) === 'Philippines' ? 'selected' : '' }}>

                                        Philippines</option>

                                    <option value="Pitcairn" {{ old('country', $project->country) === 'Pitcairn' ? 'selected' : '' }}>

                                        Pitcairn</option>

                                    <option value="Poland" {{ old('country', $project->country) === 'Poland' ? 'selected' : '' }}>

                                        Poland</option>

                                    <option value="Portugal" {{ old('country', $project->country) === 'Portugal' ? 'selected' : '' }}>

                                        Portugal</option>

                                    <option value="Puerto Rico" {{ old('country', $project->country) === 'Puerto Rico' ? 'selected' : '' }}>

                                        Puerto Rico</option>

                                    <option value="Qatar" {{ old('country', $project->country) === 'Qatar' ? 'selected' : '' }}>

                                        Qatar</option>

                                    <option value="Reunion" {{ old('country', $project->country) === 'Reunion' ? 'selected' : '' }}>

                                        Reunion</option>

                                    <option value="Romania" {{ old('country', $project->country) === 'Romania' ? 'selected' : '' }}>

                                        Romania</option>

                                    <option value="Russian Federation" {{ old('country', $project->country) ===

                                            'Russian

                                                                                                                                Federation'

                                                ? 'selected'

                                                : '' }}>

                                        Russian Federation</option>

                                    <option value="Rwanda" {{ old('country', $project->country) === 'Rwanda' ? 'selected' : '' }}>

                                        Rwanda</option>

                                    <option value="Saint Kitts and Nevis" {{ old('country', $project->country) === 'Saint Kitts and Nevis' ? 'selected' : '' }}>

                                        Saint Kitts and Nevis</option>

                                    <option value="Saint Lucia" {{ old('country', $project->country) === 'Saint Lucia' ? 'selected' : '' }}>

                                        Saint Lucia</option>

                                    <option value="Saint Vincent and the Grenadines" {{ old('country', $project->country) === 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>

                                        Saint

                                        Vincent and the Grenadines</option>

                                    <option value="Samoa" {{ old('country', $project->country) === 'Samoa' ? 'selected' : '' }}>

                                        Samoa</option>

                                    <option value="San Marino" {{ old('country', $project->country) === 'San Marino' ? 'selected' : '' }}>

                                        San Marino</option>

                                    <option value="Sao Tome and Principe" {{ old('country', $project->country) ===

                                            'Sao

                                                                                                                                Tome and Principe'

                                                ? 'selected'

                                                : '' }}>

                                        Sao Tome and Principe</option>

                                    <option value="Saudi Arabia" {{ old('country', $project->country) === 'Saudi Arabia' ? 'selected' : '' }}>

                                        Saudi Arabia</option>

                                    <option value="Senegal" {{ old('country', $project->country) === 'Senegal' ? 'selected' : '' }}>

                                        Senegal</option>

                                    <option value="Seychelles" {{ old('country', $project->country) === 'Seychelles' ? 'selected' : '' }}>

                                        Seychelles</option>

                                    <option value="Sierra Leone" {{ old('country', $project->country) === 'Sierra Leone' ? 'selected' : '' }}>

                                        Sierra Leone</option>

                                    <option value="Singapore" {{ old('country', $project->country) === 'Singapore' ? 'selected' : '' }}>

                                        Singapore</option>

                                    <option value="Slovakia (Slovak Republic)" {{ old('country', $project->country) === 'Slovakia (Slovak Republic)' ? 'selected' : '' }}>

                                        Slovakia (Slovak Republic)

                                    </option>

                                    <option value="Slovenia" {{ old('country', $project->country) === 'Slovenia' ? 'selected' : '' }}>

                                        Slovenia</option>

                                    <option value="Solomon Islands" {{ old('country', $project->country) ===

                                            'Solomon

                                                                                                                                Islands'

                                                ? 'selected'

                                                : '' }}>

                                        Solomon Islands</option>

                                    <option value="Somalia" {{ old('country', $project->country) === 'Somalia' ? 'selected' : '' }}>

                                        Somalia</option>

                                    <option value="South Africa" {{ old('country', $project->country) === 'South Africa' ? 'selected' : '' }}>

                                        South Africa</option>

                                    <option value="South Georgia and the South Sandwich Islands" {{ old('country', $project->country) === 'South Georgia and the South Sandwich Islands' ? 'selected' : '' }}>

                                        South Georgia and the South Sandwich Islands</option>

                                    <option value="Spain" {{ old('country', $project->country) === 'Spain' ? 'selected' : '' }}>

                                        Spain</option>

                                    <option value="Sri Lanka" {{ old('country', $project->country) === 'Sri Lanka' ? 'selected' : '' }}>

                                        Sri Lanka</option>

                                    <option value="St. Helena" {{ old('country', $project->country) === 'St. Helena' ? 'selected' : '' }}>

                                        St. Helena</option>

                                    <option value="St. Pierre and Miquelon" {{ old('country', $project->country) === 'St. Pierre and Miquelon' ? 'selected' : '' }}>

                                        St. Pierre and Miquelon</option>

                                    <option value="Sudan" {{ old('country', $project->country) === 'Sudan' ? 'selected' : '' }}>

                                        Sudan</option>

                                    <option value="Suriname" {{ old('country', $project->country) === 'Suriname' ? 'selected' : '' }}>

                                        Suriname</option>

                                    <option value="Svalbard and Jan Mayen Islands" {{ old('country', $project->country) === 'Svalbard and Jan Mayen Islands' ? 'selected' : '' }}>

                                        Svalbard and Jan Mayen

                                        Islands</option>

                                    <option value="Swaziland" {{ old('country', $project->country) === 'Swaziland' ? 'selected' : '' }}>

                                        Swaziland</option>

                                    <option value="Sweden" {{ old('country', $project->country) === 'Sweden' ? 'selected' : '' }}>

                                        Sweden</option>

                                    <option value="Switzerland" {{ old('country', $project->country) === 'Switzerland' ? 'selected' : '' }}>

                                        Switzerland</option>

                                    <option value="Syrian Arab Republic" {{ old('country', $project->country) === 'Syrian Arab Republic' ? 'selected' : '' }}>

                                        Syrian Arab Republic</option>

                                    <option value="Taiwan, Province of China" {{ old('country', $project->country) === 'Taiwan, Province of China' ? 'selected' : '' }}>

                                        Taiwan, Province of China

                                    </option>

                                    <option value="Tajikistan" {{ old('country', $project->country) === 'Tajikistan' ? 'selected' : '' }}>

                                        Tajikistan</option>

                                    <option value="Tanzania, United Republic of" {{ old('country', $project->country) === 'Tanzania, United Republic of' ? 'selected' : '' }}>

                                        Tanzania, United

                                        Republic of</option>

                                    <option value="Thailand" {{ old('country', $project->country) === 'Thailand' ? 'selected' : '' }}>

                                        Thailand</option>

                                    <option value="Togo" {{ old('country', $project->country) === 'Togo' ? 'selected' : '' }}>

                                        Togo</option>

                                    <option value="Tokelau" {{ old('country', $project->country) === 'Tokelau' ? 'selected' : '' }}>

                                        Tokelau</option>

                                    <option value="Tonga" {{ old('country', $project->country) === 'Tonga' ? 'selected' : '' }}>

                                        Tonga</option>

                                    <option value="Trinidad and Tobago" {{ old('country', $project->country) === 'Trinidad and Tobago' ? 'selected' : '' }}>

                                        Trinidad and Tobago</option>

                                    <option value="Tunisia" {{ old('country', $project->country) === 'Tunisia' ? 'selected' : '' }}>

                                        Tunisia</option>

                                    <option value="Turkey" {{ old('country', $project->country) === 'Turkey' ? 'selected' : '' }}>

                                        Turkey</option>

                                    <option value="Turkmenistan" {{ old('country', $project->country) === 'Turkmenistan' ? 'selected' : '' }}>

                                        Turkmenistan</option>

                                    <option value="Turks and Caicos Islands" {{ old('country', $project->country) === 'Turks and Caicos Islands' ? 'selected' : '' }}>

                                        Turks and Caicos Islands

                                    </option>

                                    <option value="Tuvalu" {{ old('country', $project->country) === 'Tuvalu' ? 'selected' : '' }}>

                                        Tuvalu</option>

                                    <option value="Uganda" {{ old('country', $project->country) === 'Uganda' ? 'selected' : '' }}>

                                        Uganda</option>

                                    <option value="Ukraine" {{ old('country', $project->country) === 'Ukraine' ? 'selected' : '' }}>

                                        Ukraine</option>

                                    <option value="United Arab Emirates" {{ old('country', $project->country) === 'United Arab Emirates' ? 'selected' : '' }}>

                                        United Arab Emirates</option>

                                    <option value="United Kingdom" {{ old('country', $project->country) ===

                                            'United

                                                                                                                                Kingdom'

                                                ? 'selected'

                                                : '' }}>

                                        United Kingdom</option>

                                    <option value="United States Minor Outlying Islands" {{ old('country', $project->country) === 'United States Minor Outlying Islands' ? 'selected' : '' }}>

                                        United

                                        States Minor Outlying Islands</option>

                                    <option value="Uruguay" {{ old('country', $project->country) === 'Uruguay' ? 'selected' : '' }}>

                                        Uruguay</option>

                                    <option value="Uzbekistan" {{ old('country', $project->country) === 'Uzbekistan' ? 'selected' : '' }}>

                                        Uzbekistan</option>

                                    <option value="Vanuatu" {{ old('country', $project->country) === 'Vanuatu' ? 'selected' : '' }}>

                                        Vanuatu</option>

                                    <option value="Venezuela" {{ old('country', $project->country) === 'Venezuela' ? 'selected' : '' }}>

                                        Venezuela</option>

                                    <option value="Vietnam" {{ old('country', $project->country) === 'Vietnam' ? 'selected' : '' }}>

                                        Vietnam</option>

                                    <option value="Virgin Islands (British)" {{ old('country', $project->country) === 'Virgin Islands (British)' ? 'selected' : '' }}>

                                        Virgin Islands (British)

                                    </option>

                                    <option value="Virgin Islands (U.S.)" {{ old('country', $project->country) === 'Virgin Islands (U.S.)' ? 'selected' : '' }}>

                                        Virgin Islands (U.S.)</option>

                                    <option value="Wallis and Futuna Islands" {{ old('country', $project->country) === 'Wallis and Futuna Islands' ? 'selected' : '' }}>

                                        Wallis and Futuna Islands

                                    </option>

                                    <option value="Western Sahara" {{ old('country', $project->country) ===

                                            'Western

                                                                                                                                Sahara'

                                                ? 'selected'

                                                : '' }}>

                                        Western Sahara</option>

                                    <option value="Yemen" {{ old('country', $project->country) === 'Yemen' ? 'selected' : '' }}>

                                        Yemen</option>

                                    <option value="Yugoslavia" {{ old('country', $project->country) === 'Yugoslavia' ? 'selected' : '' }}>

                                        Yugoslavia</option>

                                    <option value="Zambia" {{ old('country', $project->country) === 'Zambia' ? 'selected' : '' }}>Zambia

                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <label for="inputZip" class="form-label">City </label>

                            <input type="text" class="form-control" name="city" id="inputZip" placeholder="City" value="{{ old('city', $project->city) }}">



                            @error('city')

                            <div class="alert alert-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="col">

                            <button type="submit" class="btn btn-info btn-lg _effect--ripple waves-effect waves-light common_btn1">Update

                            </button>

                            <button type="button" class="btn btn-secondary btn-lg _effect--ripple waves-effect waves-light common_btn1 btn_one" onclick="route('{{ route('manage_project') }}')">Cancel</button>

                        </div>

                    </div>



                    </form>

                </div>

            </div>



        </div>



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {

            $(".chosen-select").chosen({

                width: "100%",

                disable_search_threshold: 10,

                placeholder_text_multiple: "Select Project Type"

            });

        });
    </script>

    <script>
        function route(destination) {

            window.location.href = destination;

        }
    </script>
    
    <script>
    $(document).ready(function() {
        $('#pmEmployeeName').change(function() {
            $('#pmallocation').val(''); // Clear allocation field when project manager is changed
            $('#allocation-error').hide(); // Hide error message when project manager is changed
        });

        $('#pmallocation').on('input', function() {
            validateAllocation();
        });

        function validateAllocation() {
            var allocationPercentage = $('#pmallocation').val();
            var employeeId = $('#pmEmployeeName').val();

            // $('#allocation-error').hide(); // Hide the error message by default

            if (!allocationPercentage || !employeeId) {
                $('#allocation-error').hide();
                return;
            }

            if (allocationPercentage > 100) {
                $('#allocation-error').text("Allocation percentage cannot be more than 100%");
                $('#allocation-error').show();
                return;
            }else{
                $('#allocation-error').hide();

            }

            $.ajax({
                url: '{{ route('check-allocationProjectManager') }}',
                type: 'POST',
                data: {
                    employee_id: employeeId,
                    allocation_percentage: allocationPercentage,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.error) {
                        $('#allocation-error').text(response.message);
                        $('#allocation-error').show();
                    } else {
                        $('#allocation-error').hide();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>






    @endsection