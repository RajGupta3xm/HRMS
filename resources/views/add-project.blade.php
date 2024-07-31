
@extends('header')

@section('title', 'Add Project')

@section('content')

<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        <div class="row layout-top-spacing">

            <div class="">

                <div class="row">

                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        <h4>Add Project</h4>

                    </div>

                </div>

            </div>

            @if (session('status'))

            <div class="alert alert-success">

                {{ session('status') }}

            </div>

            @endif

            @if ($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

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

                        <form method="POST" action="{{ route('insertProject') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Company</label>

                                    <select id="inputState" class="form-select" name="projectcompany">

                                        <option value="">Select Project Company</option>

                                        <option value="TechGropse Pvt Ltd." @if (old('projectcompany')=='TechGropse Pvt Ltd.' ) selected @endif>

                                            TechGropse Pvt Ltd.

                                        </option>

                                    </select>

                                    @error('projectcompany')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Name</label>

                                    <input type="text" name="projectname" class="form-control" placeholder="ProjectName" value="{{ old('projectname') }}">

                                    @error('projectname')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6" data-currency="EUR" data-flags="true">

                                    <label for="inputState" class="form-label">Project Currency</label>

                                    <select class="form-select" id="currency" name="currency">

                                        <option value="">currency</option>

                                        <option value="AFN">AFN - Afghan Afghani - ؋</option>

                                        <option value="ALL">ALL - Albanian Lek - Lek</option>

                                        <option value="DZD">DZD - Algerian Dinar - دج</option>

                                        <option value="AOA">AOA - Angolan Kwanza - Kz</option>

                                        <option value="ARS">ARS - Argentine Peso - $</option>

                                        <option value="AMD">AMD - Armenian Dram - ֏</option>

                                        <option value="AWG">AWG - Aruban Florin - ƒ</option>

                                        <option value="AUD">AUD - Australian Dollar - $</option>

                                        <option value="AZN">AZN - Azerbaijani Manat - m</option>

                                        <option value="BSD">BSD - Bahamian Dollar - B$</option>

                                        <option value="BHD">BHD - Bahraini Dinar - .د.ب</option>

                                        <option value="BDT">BDT - Bangladeshi Taka - ৳</option>

                                        <option value="BBD">BBD - Barbadian Dollar - Bds$</option>

                                        <option value="BYR">BYR - Belarusian Ruble - Br</option>

                                        <option value="BEF">BEF - Belgian Franc - fr</option>

                                        <option value="BZD">BZD - Belize Dollar - $</option>

                                        <option value="BMD">BMD - Bermudan Dollar - $</option>

                                        <option value="BTN">BTN - Bhutanese Ngultrum - Nu.</option>

                                        <option value="BTC">BTC - Bitcoin - ฿</option>

                                        <option value="BOB">BOB - Bolivian Boliviano - Bs.</option>

                                        <option value="BAM">BAM - Bosnia-Herzegovina Convertible Mark - KM</option>

                                        <option value="BWP">BWP - Botswanan Pula - P</option>

                                        <option value="BRL">BRL - Brazilian Real - R$</option>

                                        <option value="GBP">GBP - British Pound Sterling - £</option>

                                        <option value="BND">BND - Brunei Dollar - B$</option>

                                        <option value="BGN">BGN - Bulgarian Lev - Лв.</option>

                                        <option value="BIF">BIF - Burundian Franc - FBu</option>

                                        <option value="KHR">KHR - Cambodian Riel - KHR</option>

                                        <option value="CAD">CAD - Canadian Dollar - $</option>

                                        <option value="CVE">CVE - Cape Verdean Escudo - $</option>

                                        <option value="KYD">KYD - Cayman Islands Dollar - $</option>

                                        <option value="XOF">XOF - CFA Franc BCEAO - CFA</option>

                                        <option value="XAF">XAF - CFA Franc BEAC - FCFA</option>

                                        <option value="XPF">XPF - CFP Franc - ₣</option>

                                        <option value="CLP">CLP - Chilean Peso - $</option>

                                        <option value="CNY">CNY - Chinese Yuan - ¥</option>

                                        <option value="COP">COP - Colombian Peso - $</option>

                                        <option value="KMF">KMF - Comorian Franc - CF</option>

                                        <option value="CDF">CDF - Congolese Franc - FC</option>

                                        <option value="CRC">CRC - Costa Rican ColÃ³n - ₡</option>

                                        <option value="HRK">HRK - Croatian Kuna - kn</option>

                                        <option value="CUC">CUC - Cuban Convertible Peso - $, CUC</option>

                                        <option value="CZK">CZK - Czech Republic Koruna - Kč</option>

                                        <option value="DKK">DKK - Danish Krone - Kr.</option>

                                        <option value="DJF">DJF - Djiboutian Franc - Fdj</option>

                                        <option value="DOP">DOP - Dominican Peso - $</option>

                                        <option value="XCD">XCD - East Caribbean Dollar - $</option>

                                        <option value="EGP">EGP - Egyptian Pound - ج.م</option>

                                        <option value="ERN">ERN - Eritrean Nakfa - Nfk</option>

                                        <option value="EEK">EEK - Estonian Kroon - kr</option>

                                        <option value="ETB">ETB - Ethiopian Birr - Nkf</option>

                                        <option value="EUR">EUR - Euro - €</option>

                                        <option value="FKP">FKP - Falkland Islands Pound - £</option>

                                        <option value="FJD">FJD - Fijian Dollar - FJ$</option>

                                        <option value="GMD">GMD - Gambian Dalasi - D</option>

                                        <option value="GEL">GEL - Georgian Lari - ლ</option>

                                        <option value="DEM">DEM - German Mark - DM</option>

                                        <option value="GHS">GHS - Ghanaian Cedi - GH₵</option>

                                        <option value="GIP">GIP - Gibraltar Pound - £</option>

                                        <option value="GRD">GRD - Greek Drachma - ₯, Δρχ, Δρ</option>

                                        <option value="GTQ">GTQ - Guatemalan Quetzal - Q</option>

                                        <option value="GNF">GNF - Guinean Franc - FG</option>

                                        <option value="GYD">GYD - Guyanaese Dollar - $</option>

                                        <option value="HTG">HTG - Haitian Gourde - G</option>

                                        <option value="HNL">HNL - Honduran Lempira - L</option>

                                        <option value="HKD">HKD - Hong Kong Dollar - $</option>

                                        <option value="HUF">HUF - Hungarian Forint - Ft</option>

                                        <option value="ISK">ISK - Icelandic KrÃ³na - kr</option>

                                        <option value="INR">INR - Indian Rupee - ₹</option>

                                        <option value="IDR">IDR - Indonesian Rupiah - Rp</option>

                                        <option value="IRR">IRR - Iranian Rial - ﷼</option>

                                        <option value="IQD">IQD - Iraqi Dinar - د.ع</option>

                                        <option value="ILS">ILS - Israeli New Sheqel - ₪</option>

                                        <option value="ITL">ITL - Italian Lira - L,£</option>

                                        <option value="JMD">JMD - Jamaican Dollar - J$</option>

                                        <option value="JPY">JPY - Japanese Yen - ¥</option>

                                        <option value="JOD">JOD - Jordanian Dinar - ا.د</option>

                                        <option value="KZT">KZT - Kazakhstani Tenge - лв</option>

                                        <option value="KES">KES - Kenyan Shilling - KSh</option>

                                        <option value="KWD">KWD - Kuwaiti Dinar - ك.د</option>

                                        <option value="KGS">KGS - Kyrgystani Som - лв</option>

                                        <option value="LAK">LAK - Laotian Kip - ₭</option>

                                        <option value="LVL">LVL - Latvian Lats - Ls</option>

                                        <option value="LBP">LBP - Lebanese Pound - £</option>

                                        <option value="LSL">LSL - Lesotho Loti - L</option>

                                        <option value="LRD">LRD - Liberian Dollar - $</option>

                                        <option value="LYD">LYD - Libyan Dinar - د.ل</option>

                                        <option value="LTL">LTL - Lithuanian Litas - Lt</option>

                                        <option value="MOP">MOP - Macanese Pataca - $</option>

                                        <option value="MKD">MKD - Macedonian Denar - ден</option>

                                        <option value="MGA">MGA - Malagasy Ariary - Ar</option>

                                        <option value="MWK">MWK - Malawian Kwacha - MK</option>

                                        <option value="MYR">MYR - Malaysian Ringgit - RM</option>

                                        <option value="MVR">MVR - Maldivian Rufiyaa - Rf</option>

                                        <option value="MRO">MRO - Mauritanian Ouguiya - MRU</option>

                                        <option value="MUR">MUR - Mauritian Rupee - ₨</option>

                                        <option value="MXN">MXN - Mexican Peso - $</option>

                                        <option value="MDL">MDL - Moldovan Leu - L</option>

                                        <option value="MNT">MNT - Mongolian Tugrik - ₮</option>

                                        <option value="MAD">MAD - Moroccan Dirham - MAD</option>

                                        <option value="MZM">MZM - Mozambican Metical - MT</option>

                                        <option value="MMK">MMK - Myanmar Kyat - K</option>

                                        <option value="NAD">NAD - Namibian Dollar - $</option>

                                        <option value="NPR">NPR - Nepalese Rupee - ₨</option>

                                        <option value="ANG">ANG - Netherlands Antillean Guilder - ƒ</option>

                                        <option value="TWD">TWD - New Taiwan Dollar - $</option>

                                        <option value="NZD">NZD - New Zealand Dollar - $</option>

                                        <option value="NIO">NIO - Nicaraguan CÃ³rdoba - C$</option>

                                        <option value="NGN">NGN - Nigerian Naira - ₦</option>

                                        <option value="KPW">KPW - North Korean Won - ₩</option>

                                        <option value="NOK">NOK - Norwegian Krone - kr</option>

                                        <option value="OMR">OMR - Omani Rial - .ع.ر</option>

                                        <option value="PKR">PKR - Pakistani Rupee - ₨</option>

                                        <option value="PAB">PAB - Panamanian Balboa - B/.</option>

                                        <option value="PGK">PGK - Papua New Guinean Kina - K</option>

                                        <option value="PYG">PYG - Paraguayan Guarani - ₲</option>

                                        <option value="PEN">PEN - Peruvian Nuevo Sol - S/.</option>

                                        <option value="PHP">PHP - Philippine Peso - ₱</option>

                                        <option value="PLN">PLN - Polish Zloty - zł</option>

                                        <option value="QAR">QAR - Qatari Rial - ق.ر</option>

                                        <option value="RON">RON - Romanian Leu - lei</option>

                                        <option value="RUB">RUB - Russian Ruble - ₽</option>

                                        <option value="RWF">RWF - Rwandan Franc - FRw</option>

                                        <option value="SVC">SVC - Salvadoran ColÃ³n - ₡</option>

                                        <option value="WST">WST - Samoan Tala - SAT</option>

                                        <option value="SAR">SAR - Saudi Riyal - ﷼</option>

                                        <option value="RSD">RSD - Serbian Dinar - din</option>

                                        <option value="SCR">SCR - Seychellois Rupee - SRe</option>

                                        <option value="SLL">SLL - Sierra Leonean Leone - Le</option>

                                        <option value="SGD">SGD - Singapore Dollar - $</option>

                                        <option value="SKK">SKK - Slovak Koruna - Sk</option>

                                        <option value="SBD">SBD - Solomon Islands Dollar - Si$</option>

                                        <option value="SOS">SOS - Somali Shilling - Sh.so.</option>

                                        <option value="ZAR">ZAR - South African Rand - R</option>

                                        <option value="KRW">KRW - South Korean Won - ₩</option>

                                        <option value="XDR">XDR - Special Drawing Rights - SDR</option>

                                        <option value="LKR">LKR - Sri Lankan Rupee - Rs</option>

                                        <option value="SHP">SHP - St. Helena Pound - £</option>

                                        <option value="SDG">SDG - Sudanese Pound - .س.ج</option>

                                        <option value="SRD">SRD - Surinamese Dollar - $</option>

                                        <option value="SZL">SZL - Swazi Lilangeni - E</option>

                                        <option value="SEK">SEK - Swedish Krona - kr</option>

                                        <option value="CHF">CHF - Swiss Franc - CHf</option>

                                        <option value="SYP">SYP - Syrian Pound - LS</option>

                                        <option value="STD">STD - São Tomé and Príncipe Dobra - Db</option>

                                        <option value="TJS">TJS - Tajikistani Somoni - SM</option>

                                        <option value="TZS">TZS - Tanzanian Shilling - TSh</option>

                                        <option value="THB">THB - Thai Baht - ฿</option>

                                        <option value="TOP">TOP - Tongan pa'anga - $</option>

                                        <option value="TTD">TTD - Trinidad & Tobago Dollar - $</option>

                                        <option value="TND">TND - Tunisian Dinar - ت.د</option>

                                        <option value="TRY">TRY - Turkish Lira - ₺</option>

                                        <option value="TMT">TMT - Turkmenistani Manat - T</option>

                                        <option value="UGX">UGX - Ugandan Shilling - USh</option>

                                        <option value="UAH">UAH - Ukrainian Hryvnia - ₴</option>

                                        <option value="AED">AED - United Arab Emirates Dirham - إ.د</option>

                                        <option value="UYU">UYU - Uruguayan Peso - $</option>

                                        <option value="USD">USD - US Dollar - $</option>

                                        <option value="UZS">UZS - Uzbekistan Som - лв</option>

                                        <option value="VUV">VUV - Vanuatu Vatu - VT</option>

                                        <option value="VEF">VEF - Venezuelan BolÃ­var - Bs</option>

                                        <option value="VND">VND - Vietnamese Dong - ₫</option>

                                        <option value="YER">YER - Yemeni Rial - ﷼</option>

                                        <option value="ZMK">ZMK - Zambian Kwacha - ZK</option>

                                    </select>

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Project Budget</label>

                                    <input type="number" class="form-control" id="inputZip" name="projectbudget" placeholder="Project Budget">

                                    @error('projectbudget')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">CSM</label>

                                    <select id="inputState" class="form-select" name="csm">

                                        <option selected value="">Select CSM</option>

                                        <option value="Aman Mishra">Aman Mishra</option>

                                        <option value="Anup Kumar">Anup Kumar</option>

                                        <option value="Sumit Dhiman">Sumit Dhiman</option>

                                    </select>

                                    @error('csm')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Tags</label>

                                    <input type="text" class="form-control" id="inputZip" name="tags" placeholder="Tags">

                                    @error('tags')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Start Date</label>

                                    <input type="date" class="form-control" name="projectstartdate" id="inputZip" placeholder="Tags">

                                    @error('projectstartdate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">End Date</label>

                                    <input type="date" class="form-control" name="projectenddate" id="inputZip" placeholder="date">

                                    @error('projectenddate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="form-group mb-4 col-md-6">

                                    <label for="inputState" class="form-label">Service Type</label>

                                    <select id="inputState" class="form-select" name="sc">

                                        <option selected value="">Select ServiceType</option>

                                        <option value="mannage Service">Mannage Service</option>

                                        <option value="Time &Metrial">Time & Metrial</option>

                                        <option value="Support Maintance">Support Maintance</option>

                                    </select>

                                    @error('sc')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Status</label>

                                    <select id="inputState" class="form-select" name="status">

                                        <option selected value="">Select Status</option>

                                        <option value="Active">Active</option>

                                        <option value="InActive">InActive</option>

                                        <option value="Complected ">Complected </option>

                                    </select>

                                    @error('status')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <label for="inputState">Project Manager</label>
                                    <select id="pmEmployeeName" class="form-select @error('pmEmployeeName') is-invalid @enderror" name="pmEmployeeName">
                                        <option value="">Select Project Manager</option>
                                        @foreach ($projectManagers as $manager)
                                        @if ($manager['designation'] === 'Project Manager')
                                        <option value="{{ $manager['id'] }}">{{ $manager['name'] }}</option>
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
                                </div>


                                <div class="col-md-6">

                                    <label for="inputState" class="form-label">Project Type</label>

                                    <select multiple class="chosen-select" name="projecttype[]">

                                        <option value="Web">Web</option>

                                        <option value="Andriod">Andriod</option>

                                        <option value="Ios">Ios</option>

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

                    <div class="widget-content widget-content-area">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Client Name</label>

                                <input type="text" class="form-control" name="cilentname" id="inputZip" placeholder="Client Name">

                                @error('cilentname')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Client Email</label>

                                <input type="email" class="form-control" name="cilentemail" id="inputZip" placeholder="Client Email">

                                @error('cilentemail')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Company Name</label>

                                <input type="text" class="form-control" name="companyname" id="inputZip" placeholder="Company Name">

                                @error('companyname')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Client Phone</label>

                                <input type="number" class="form-control" name="cilentphone" id="inputZip" placeholder="Client Phone">

                                @error('cilentphone')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="text">Country</label>

                                    <select id="inputState" class="form-select" name="country" required autocomplete="off">

                                        <option value="United States">United States</option>

                                        <option value="Afghanistan">Afghanistan</option>

                                        <option value="Albania">Albania</option>

                                        <option value="Algeria">Algeria</option>

                                        <option value="American Samoa">American Samoa</option>

                                        <option value="Andorra">Andorra</option>

                                        <option value="Angola">Angola</option>

                                        <option value="Anguilla">Anguilla</option>

                                        <option value="Antarctica">Antarctica</option>

                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>

                                        <option value="Argentina">Argentina</option>

                                        <option value="Armenia">Armenia</option>

                                        <option value="Aruba">Aruba</option>

                                        <option value="Australia">Australia</option>

                                        <option value="Austria">Austria</option>

                                        <option value="Azerbaijan">Azerbaijan</option>

                                        <option value="Bahamas">Bahamas</option>

                                        <option value="Bahrain">Bahrain</option>

                                        <option value="Bangladesh">Bangladesh</option>

                                        <option value="Barbados">Barbados</option>

                                        <option value="Belarus">Belarus</option>

                                        <option value="Belgium">Belgium</option>

                                        <option value="Belize">Belize</option>

                                        <option value="Benin">Benin</option>

                                        <option value="Bermuda">Bermuda</option>

                                        <option value="Bhutan">Bhutan</option>

                                        <option value="Bolivia">Bolivia</option>

                                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>

                                        <option value="Botswana">Botswana</option>

                                        <option value="Bouvet Island">Bouvet Island</option>

                                        <option value="Brazil">Brazil</option>

                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory

                                        </option>

                                        <option value="Brunei Darussalam">Brunei Darussalam</option>

                                        <option value="Bulgaria">Bulgaria</option>

                                        <option value="Burkina Faso">Burkina Faso</option>

                                        <option value="Burundi">Burundi</option>

                                        <option value="Cambodia">Cambodia</option>

                                        <option value="Cameroon">Cameroon</option>

                                        <option value="Canada">Canada</option>

                                        <option value="Cape Verde">Cape Verde</option>

                                        <option value="Cayman Islands">Cayman Islands</option>

                                        <option value="Central African Republic">Central African Republic</option>

                                        <option value="Chad">Chad</option>

                                        <option value="Chile">Chile</option>

                                        <option value="China">China</option>

                                        <option value="Christmas Island">Christmas Island</option>

                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>

                                        <option value="Colombia">Colombia</option>

                                        <option value="Comoros">Comoros</option>

                                        <option value="Congo">Congo</option>

                                        <option value="Congo, the Democratic Republic of the">Congo, the Democratic

                                            Republic of the</option>

                                        <option value="Cook Islands">Cook Islands</option>

                                        <option value="Costa Rica">Costa Rica</option>

                                        <option value="Cote dIvoire">Cote dIvoire</option>

                                        <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>

                                        <option value="Cuba">Cuba</option>

                                        <option value="Cyprus">Cyprus</option>

                                        <option value="Czech Republic">Czech Republic</option>

                                        <option value="Denmark">Denmark</option>

                                        <option value="Djibouti">Djibouti</option>

                                        <option value="Dominica">Dominica</option>

                                        <option value="Dominican Republic">Dominican Republic</option>

                                        <option value="East Timor">East Timor</option>

                                        <option value="Ecuador">Ecuador</option>

                                        <option value="Egypt">Egypt</option>

                                        <option value="El Salvador">El Salvador</option>

                                        <option value="Equatorial Guinea">Equatorial Guinea</option>

                                        <option value="Eritrea">Eritrea</option>

                                        <option value="Estonia">Estonia</option>

                                        <option value="Ethiopia">Ethiopia</option>

                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)

                                        </option>

                                        <option value="Faroe Islands">Faroe Islands</option>

                                        <option value="Fiji">Fiji</option>

                                        <option value="Finland">Finland</option>

                                        <option value="France">France</option>

                                        <option value="France Metropolitan">France Metropolitan</option>

                                        <option value="French Guiana">French Guiana</option>

                                        <option value="French Polynesia">French Polynesia</option>

                                        <option value="French Southern Territories">French Southern Territories

                                        </option>

                                        <option value="Gabon">Gabon</option>

                                        <option value="Gambia">Gambia</option>

                                        <option value="Georgia">Georgia</option>

                                        <option value="Germany">Germany</option>

                                        <option value="Ghana">Ghana</option>

                                        <option value="Gibraltar">Gibraltar</option>

                                        <option value="Greece">Greece</option>

                                        <option value="Greenland">Greenland</option>

                                        <option value="Grenada">Grenada</option>

                                        <option value="Guadeloupe">Guadeloupe</option>

                                        <option value="Guam">Guam</option>

                                        <option value="Guatemala">Guatemala</option>

                                        <option value="Guinea">Guinea</option>

                                        <option value="Guinea-Bissau">Guinea-Bissau</option>

                                        <option value="Guyana">Guyana</option>

                                        <option value="Haiti">Haiti</option>

                                        <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands

                                        </option>

                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)

                                        </option>

                                        <option value="Honduras">Honduras</option>

                                        <option value="Hong Kong">Hong Kong</option>

                                        <option value="Hungary">Hungary</option>

                                        <option value="Iceland">Iceland</option>

                                        <option value="India">India</option>

                                        <option value="Indonesia">Indonesia</option>

                                        <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>

                                        <option value="Iraq">Iraq</option>

                                        <option value="Ireland">Ireland</option>

                                        <option value="Israel">Israel</option>

                                        <option value="Italy">Italy</option>

                                        <option value="Jamaica">Jamaica</option>

                                        <option value="Japan">Japan</option>

                                        <option value="Jordan">Jordan</option>

                                        <option value="Kazakhstan">Kazakhstan</option>

                                        <option value="Kenya">Kenya</option>

                                        <option value="Kiribati">Kiribati</option>

                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic

                                            People's Republic of</option>

                                        <option value="Korea, Republic of">Korea, Republic of</option>

                                        <option value="Kuwait">Kuwait</option>

                                        <option value="Kyrgyzstan">Kyrgyzstan</option>

                                        <option value="Lao, People's Democratic Republic">Lao, People's Democratic

                                            Republic</option>

                                        <option value="Latvia">Latvia</option>

                                        <option value="Lebanon">Lebanon</option>

                                        <option value="Lesotho">Lesotho</option>

                                        <option value="Liberia">Liberia</option>

                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>

                                        <option value="Liechtenstein">Liechtenstein</option>

                                        <option value="Lithuania">Lithuania</option>

                                        <option value="Luxembourg">Luxembourg</option>

                                        <option value="Macau">Macau</option>

                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The

                                            Former Yugoslav Republic of</option>

                                        <option value="Madagascar">Madagascar</option>

                                        <option value="Malawi">Malawi</option>

                                        <option value="Malaysia">Malaysia</option>

                                        <option value="Maldives">Maldives</option>

                                        <option value="Mali">Mali</option>

                                        <option value="Malta">Malta</option>

                                        <option value="Marshall Islands">Marshall Islands</option>

                                        <option value="Martinique">Martinique</option>

                                        <option value="Mauritania">Mauritania</option>

                                        <option value="Mauritius">Mauritius</option>

                                        <option value="Mayotte">Mayotte</option>

                                        <option value="Mexico">Mexico</option>

                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of

                                        </option>

                                        <option value="Moldova, Republic of">Moldova, Republic of</option>

                                        <option value="Monaco">Monaco</option>

                                        <option value="Mongolia">Mongolia</option>

                                        <option value="Montserrat">Montserrat</option>

                                        <option value="Morocco">Morocco</option>

                                        <option value="Mozambique">Mozambique</option>

                                        <option value="Myanmar">Myanmar</option>

                                        <option value="Namibia">Namibia</option>

                                        <option value="Nauru">Nauru</option>

                                        <option value="Nepal">Nepal</option>

                                        <option value="Netherlands">Netherlands</option>

                                        <option value="Netherlands Antilles">Netherlands Antilles</option>

                                        <option value="New Caledonia">New Caledonia</option>

                                        <option value="New Zealand">New Zealand</option>

                                        <option value="Nicaragua">Nicaragua</option>

                                        <option value="Niger">Niger</option>

                                        <option value="Nigeria">Nigeria</option>

                                        <option value="Niue">Niue</option>

                                        <option value="Norfolk Island">Norfolk Island</option>

                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>

                                        <option value="Norway">Norway</option>

                                        <option value="Oman">Oman</option>

                                        <option value="Pakistan">Pakistan</option>

                                        <option value="Palau">Palau</option>

                                        <option value="Panama">Panama</option>

                                        <option value="Papua New Guinea">Papua New Guinea</option>

                                        <option value="Paraguay">Paraguay</option>

                                        <option value="Peru">Peru</option>

                                        <option value="Philippines">Philippines</option>

                                        <option value="Pitcairn">Pitcairn</option>

                                        <option value="Poland">Poland</option>

                                        <option value="Portugal">Portugal</option>

                                        <option value="Puerto Rico">Puerto Rico</option>

                                        <option value="Qatar">Qatar</option>

                                        <option value="Reunion">Reunion</option>

                                        <option value="Romania">Romania</option>

                                        <option value="Russian Federation">Russian Federation</option>

                                        <option value="Rwanda">Rwanda</option>

                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>

                                        <option value="Saint Lucia">Saint Lucia</option>

                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the

                                            Grenadines</option>

                                        <option value="Samoa">Samoa</option>

                                        <option value="San Marino">San Marino</option>

                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>

                                        <option value="Saudi Arabia">Saudi Arabia</option>

                                        <option value="Senegal">Senegal</option>

                                        <option value="Seychelles">Seychelles</option>

                                        <option value="Sierra Leone">Sierra Leone</option>

                                        <option value="Singapore">Singapore</option>

                                        <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>

                                        <option value="Slovenia">Slovenia</option>

                                        <option value="Solomon Islands">Solomon Islands</option>

                                        <option value="Somalia">Somalia</option>

                                        <option value="South Africa">South Africa</option>

                                        <option value="South Georgia and the South Sandwich Islands">South Georgia and

                                            the South Sandwich Islands</option>

                                        <option value="Spain">Spain</option>

                                        <option value="Sri Lanka">Sri Lanka</option>

                                        <option value="St. Helena">St. Helena</option>

                                        <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>

                                        <option value="Sudan">Sudan</option>

                                        <option value="Suriname">Suriname</option>

                                        <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands

                                        </option>

                                        <option value="Swaziland">Swaziland</option>

                                        <option value="Sweden">Sweden</option>

                                        <option value="Switzerland">Switzerland</option>

                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>

                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>

                                        <option value="Tajikistan">Tajikistan</option>

                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of

                                        </option>

                                        <option value="Thailand">Thailand</option>

                                        <option value="Togo">Togo</option>

                                        <option value="Tokelau">Tokelau</option>

                                        <option value="Tonga">Tonga</option>

                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>

                                        <option value="Tunisia">Tunisia</option>

                                        <option value="Turkey">Turkey</option>

                                        <option value="Turkmenistan">Turkmenistan</option>

                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>

                                        <option value="Tuvalu">Tuvalu</option>

                                        <option value="Uganda">Uganda</option>

                                        <option value="Ukraine">Ukraine</option>

                                        <option value="United Arab Emirates">United Arab Emirates</option>

                                        <option value="United Kingdom">United Kingdom</option>

                                        <option value="United States Minor Outlying Islands">United States Minor

                                            Outlying Islands</option>

                                        <option value="Uruguay">Uruguay</option>

                                        <option value="Uzbekistan">Uzbekistan</option>

                                        <option value="Vanuatu">Vanuatu</option>

                                        <option value="Venezuela">Venezuela</option>

                                        <option value="Vietnam">Vietnam</option>

                                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>

                                        <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>

                                        <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>

                                        <option value="Western Sahara">Western Sahara</option>

                                        <option value="Yemen">Yemen</option>

                                        <option value="Yugoslavia">Yugoslavia</option>

                                        <option value="Zambia">Zambia</option>

                                        <option value="Zimbabwe">Zimbabwe</option>

                                    </select>

                                </div>

                                @error('country')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">City </label>

                                <input type="text" class="form-control" name="city" id="inputZip" placeholder="City">

                                @error('city')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <button type="submit" class="btn btn-success">Submit</button>

                                <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>

                            </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

        <script>
            function goBack() {

                window.history.back();

            }
        </script>

        <script>
            var input = document.querySelector("#inputPhone");

            var iti = window.intlTelInput(input, {

                initialCountry: "auto",

                separateDialCode: true,

                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",

            });

            input.addEventListener("countrychange", function() {

                var countryData = iti.getSelectedCountryData();

                var flagElement = document.querySelector("#flag");

                flagElement.className = "flag-icon flag-icon-" + countryData.iso2;

            });
        </script>

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
            $(document).ready(function() {
                $('#pmallocation').on('input', function() {
                    checkAllocationPercentage();
                });

                $('#pmEmployeeName').change(function() {
                    checkAllocationPercentage();
                });

                function checkAllocationPercentage() {
                    var allocationPercentage = $('#pmallocation').val();
                    var employeeId = $('#pmEmployeeName').val();

                    if (!allocationPercentage || !employeeId) {
                        $('#allocation-error').hide();
                        return;
                    }

                    if (allocationPercentage > 100) {
                        $('#allocation-error').text("Allocation percentage cannot be more than 100%");
                        $('#allocation-error').show();
                        return;
                    } else {
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