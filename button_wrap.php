<?php
function button_wrap($hebcit,$pasuk,$url,$engcit){
    //    print_r(array($pasuk,$url,$hebcit,$engcit));
?>
     <div class="tooltip expand"
      data-title="Click button to copy to clipboard כפתורים להכנסת החומר ללוּחַ גְּזִירִים">
 
<?php $bt='<button data-clipboard-text="';
                     echo $bt.$hebcit.'">מראה מקום</button>'.PHP_EOL;
                     echo $bt.htmlentities($pasuk).'">הטקסט</button>'.PHP_EOL;
                     if (strlen($url)>0) {echo $bt.htmlentities($url).'">קישור</button>'.PHP_EOL;}
                     echo $bt.htmlentities($pasuk).$hebcit.'">הטקסט ומקורו</button>'.PHP_EOL;
                     echo $bt.$engcit.'">Citation</button>'.PHP_EOL;
                     ?>
     </div>


<!--    <script src="../script/citapp.js"> </script> -->
    <script src="../script/clipboard.min.js"></script>

    <!-- 3. Instantiate clipboard by passing a list of HTML elements -->
    <script>
      var btns = document.querySelectorAll('button');
      var clipboard = new ClipboardJS(btns);

      clipboard.on('success', function (e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
      });
      clipboard.on('error', function (e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
      });
    </script>

<?php
}


