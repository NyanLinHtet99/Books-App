<div id="jqxWidget">
    <div>
        <div id="window">
            <div id="windowHeader">
                <span class="h5">
                    <img src="/favicon.png" alt="" class="rounded-2"
                        style="margin-right: 15px;width:20px;height:20px" />User Profile
                </span>
            </div>
            <div style="overflow-x: hidden;" id="windowContent">
                <x-profile></x-profile>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var basicDemo = (function() {
        //Adding event listeners
        // function _addEventListeners() {
        //     $('#resizeCheckBox').on('change', function(event) {
        //         if (event.args.checked) {
        //             $('#window').jqxWindow('resizable', true);
        //         } else {
        //             $('#window').jqxWindow('resizable', false);
        //         }
        //     });
        //     $('#dragCheckBox').on('change', function(event) {
        //         if (event.args.checked) {
        //             $('#window').jqxWindow('draggable', true);
        //         } else {
        //             $('#window').jqxWindow('draggable', false);
        //         }
        //     });
        //     $('#showWindowButton').click(function() {
        //         $('#window').jqxWindow('open');
        //     });
        //     $('#hideWindowButton').click(function() {
        //         $('#window').jqxWindow('close');
        //     });
        // };
        // //Creating all page elements which are jqxWidgets
        // function _createElements() {
        //     $('#showWindowButton').jqxButton({
        //         width: '70px'
        //     });
        //     $('#hideWindowButton').jqxButton({
        //         width: '65px'
        //     });
        //     $('#resizeCheckBox').jqxCheckBox({
        //         width: '185px',
        //         checked: true
        //     });
        //     $('#dragCheckBox').jqxCheckBox({
        //         width: '185px',
        //         checked: true
        //     });
        // };
        //Creating the demo window
        function _createWindow() {
            // var jqxWidget = $('#jqxWidget');
            // var offset = jqxWidget.offset();
            $('#window').jqxWindow({
                position: 'center',
                showCollapseButton: true,
                maxHeight: 700,
                maxWidth: 800,
                minHeight: 400,
                minWidth: 500,
                height: 450,
                width: 700,
                autoOpen: false,
                theme: 'light',
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
                // _createElements();
                // //Attaching event listeners
                // _addEventListeners();
                //Adding jqxWindow
                _createWindow();
            }
        };
    }());
    $(function() {
        //Initializing the demo
        basicDemo.init();

        document.querySelector('#editImage').addEventListener('click', () => {
            document.querySelector('#inputImage').click();
        });
        $("#name").jqxInput({
            placeHolder: "Name",
            height: 30,
            width: '100%',
            minLength: 1,
            theme: 'light'
        });
        $("#email").jqxInput({
            placeHolder: "Email",
            height: 30,
            width: '100%',
            minLength: 1,
            theme: 'light'
        });
        $('#profile').click(function() {
            $('#window').jqxWindow('open');
        });
        $('.userForm-input').on('change', function() {
            $(this).addClass('border-info border-bottom-3');
            $('#userFormBtn').removeAttr("disabled");
        });
        $('#inputImage').on('change', function() {
            $('#avatar').addClass('border border-info border-4');
            $('#imageUpdateAlert').removeClass('d-none');
            $('#userFormBtn').removeAttr("disabled");
        });
        // $('#bio').on('change', function() {
        //     $('#userFormBtn').removeAttr("disabled");
        // })
        @if ($errors->any())
            $('#window').jqxWindow('open');
        @endif
        @if (session()->has('infoUpdated'))
            $('#window').jqxWindow('open');
        @endif
    });
</script>
