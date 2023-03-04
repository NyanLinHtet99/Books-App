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
        basicDemo.init();
    });
</script>
