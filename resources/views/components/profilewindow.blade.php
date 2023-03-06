<div id="jqxWidget">
    <div style="float: left;">
        <div>
            <input type="button" value="Open" id="showWindowButton" />
            <input type="button" value="Close" id="hideWindowButton" style="margin-left: 5px" />
        </div>
        <div style="margin-top: 10px;">
            <div id="resizeCheckBox">
                Resizable
            </div>
            <div id="dragCheckBox">
                Enable drag
            </div>
        </div>
    </div>
    <div style="width: 100%; height: 650px; margin-top: 50px;" id="mainDemoContainer">
        <div id="window">
            <div id="windowHeader">
                <span class="h4">
                    <img src="/favicon.png" alt="" class="rounded-2"
                        style="margin-right: 15px;width:30px;height:30px" />User Profile
                </span>
            </div>
            <div style="overflow-x: hidden;" id="windowContent">
                <x-profile></x-profile>
            </div>
        </div>
    </div>
    <input type="text" id="input" />

</div>
<script type="text/javascript">
    var basicDemo = (function() {
        //Adding event listeners
        function _addEventListeners() {
            $('#resizeCheckBox').on('change', function(event) {
                if (event.args.checked) {
                    $('#window').jqxWindow('resizable', true);
                } else {
                    $('#window').jqxWindow('resizable', false);
                }
            });
            $('#dragCheckBox').on('change', function(event) {
                if (event.args.checked) {
                    $('#window').jqxWindow('draggable', true);
                } else {
                    $('#window').jqxWindow('draggable', false);
                }
            });
            $('#showWindowButton').click(function() {
                $('#window').jqxWindow('open');
            });
            $('#hideWindowButton').click(function() {
                $('#window').jqxWindow('close');
            });
        };
        //Creating all page elements which are jqxWidgets
        function _createElements() {
            $('#showWindowButton').jqxButton({
                width: '70px'
            });
            $('#hideWindowButton').jqxButton({
                width: '65px'
            });
            $('#resizeCheckBox').jqxCheckBox({
                width: '185px',
                checked: true
            });
            $('#dragCheckBox').jqxCheckBox({
                width: '185px',
                checked: true
            });
        };
        //Creating the demo window
        function _createWindow() {
            var jqxWidget = $('#jqxWidget');
            var offset = jqxWidget.offset();
            $('#window').jqxWindow({
                position: {
                    x: offset.left + 50,
                    y: offset.top + 50
                },
                showCollapseButton: true,
                maxHeight: 500,
                maxWidth: 800,
                minHeight: 400,
                minWidth: 500,
                height: 400,
                width: 600,
                initContent: function() {
                    // $('#tab').jqxTabs({
                    //     height: '100%',
                    //     width: '100%'
                    // });
                    $('#window').jqxWindow('focus');
                }
            });
        };
        return {
            config: {
                dragArea: null
            },
            init: function() {
                //Creating all jqxWindgets except the window
                _createElements();
                //Attaching event listeners
                _addEventListeners();
                //Adding jqxWindow
                _createWindow();
            }
        };
    }());
    $(function() {
        //Initializing the demo
        var countries = new Array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antarctica",
            "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas",
            "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda",
            "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria",
            "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde",
            "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros",
            "Congo, Democratic Republic", "Congo, Republic of the", "Costa Rica", "Cote d'Ivoire",
            "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
            "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea",
            "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia",
            "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau",
            "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran",
            "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya",
            "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon",
            "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia",
            "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
            "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Mongolia", "Morocco", "Monaco",
            "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger",
            "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru",
            "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Samoa",
            "San Marino", " Sao Tome", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles",
            "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
            "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland",
            "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago",
            "Tunisia", "Turkey", "Turkmenistan", "Uganda", "Ukraine", "United Arab Emirates",
            "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam",
            "Yemen", "Zambia", "Zimbabwe");
        $("#input").jqxInput({
            placeHolder: "Enter a Country",
            height: 30,
            width: 250,
            minLength: 1,
            source: countries,
            theme: "light",
        });
        basicDemo.init();
    });
</script>
