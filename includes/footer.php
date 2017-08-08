 </div>

        <footer class="text-center">
            <hr>
            <small>Coded by <a href="http://github.com/echilaka1/" target="_blank">Ikay</a> in OlotuSquare</small>
        </footer>
      <script src="greensock-js/src/minified/TweenMax.min.js"></script>
      <script src="main.js"></script>
      <script>
      // grab everything we need
      const amountInput    = document.querySelector('[name=amount]');
      const quantityInput  = document.querySelector('[name=quantity]');
      const total          = document.querySelector('.total');
      const quantityLabel  = document.querySelector('.quantity-label');

      // create the functions that we'll need   
      function calculateItemsCost() {
        const amount    = amountInput.value;
        const quantity  = quantityInput.value;
        const cost      = amount * quantity;
        console.log(cost);
        total.value     = /*'N' + */ cost.toFixed(2);
      }

      function updateQuantityLabel() {
        const quantity          = quantityInput.value;
        quantityLabel.innerText = quantity;
      }

      // on first run
      calculateItemsCost();

      // add our event listeners     
      amountInput.addEventListener('input', calculateItemsCost);
      quantityInput.addEventListener('input', calculateItemsCost);
      quantityInput.addEventListener('input', updateQuantityLabel);
      
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html> 