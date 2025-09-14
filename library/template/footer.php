</section> 

<footer class="footer has-background-dark">
          <div class="columns">

               <div class="column is-6">
                    <h4 class="title is-5 has-text-white">
                         <i class="fas fa-tools mr-2"></i>
                         Tecnologías
                    </h4>
                    <div class="tags">
                         <span class="tag is-primary">PHP</span>
                         <span class="tag is-info">Bulma CSS</span>
                         <span class="tag is-success">JavaScript</span>
                         <span class="tag is-warning">API REST</span>
                         <span class="tag is-danger">HTML5</span>
                         <span class="tag is-link">CSS3</span>
                    </div>
               </div>

               <div class="column is-6">
                    <h4 class="title is-5 has-text-white">
                         <i class="fas fa-info-circle mr-2"></i>
                         Información
                    </h4>
                    <p class="has-text-grey-light">
                         <i class="fas fa-calendar mr-1"></i>
                         Desarrollado en <?php echo date('Y'); ?>
                    </p>
                    <p class="has-text-grey-light">
                         <i class="fas fa-user mr-1"></i>
                         Proyecto académico
                    </p>
               </div>
          </div>
</footer>

<style>
     .footer {
          background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
          box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
     }

     .footer .title {
          border-bottom: 2px solid #667eea;
          padding-bottom: 0.5rem;
          margin-bottom: 1rem;
     }

     .footer .tag {
          margin: 0.25rem;
          font-weight: 600;
     }

     .footer hr {
          margin: 2rem 0 1rem 0;
          opacity: 0.3;
     }
</style>

<!-- Scripts adicionales -->
<script>
     // Smooth scrolling para links internos
     document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function(e) {
               e.preventDefault();
               const target = document.querySelector(this.getAttribute('href'));
               if (target) {
                    target.scrollIntoView({
                         behavior: 'smooth'
                    });
               }
          });
     });

     // Mejorar accesibilidad con teclado
     document.addEventListener('keydown', function(e) {
          if (e.key === 'Tab') {
               document.body.classList.add('keyboard-navigation');
          }
     });

     document.addEventListener('mousedown', function() {
          document.body.classList.remove('keyboard-navigation');
     });
</script>

</body>

</html>