 <!--footer-->
 <footer id="mainFooter">
     <div class="search-container" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="3000">
         <form id="coolmaths-search" action="default.html">
             <input id="text-search" type="text" placeholder="Search..." name="search" />

             <button type="submit"> <i class="fa fa-magnifying-glass"></i></button>
         </form>
     </div>
     <script type="text/javascript">
         document.getElementById('coolmaths-search').onsubmit = function() {
             window.location = 'http://www.google.com/search?q=' + document.getElementById('text-search').value;
             return false;
         }
     </script>

     <div class="icons">
         <center>
             <h2>Join Us</h2>
         </center>
         <div class="social-media-icons">
             <a href='https://www.facebook.com/mohit.chandra.336717/' target='_blank' title="Join us on Facebook">
                 <i class="fa-brands fa-facebook-f"></i>
             </a>
             <a href="https://twitter.com/MOHIT11725010" target='_blank' title="Join us on Twitter">
                 <i class="fa-brands fa-twitter"></i>
             </a>
             <a href="https://in.linkedin.com/" target='_blank' title="Join us on Linkedin">
                 <i class="fa-brands fa-linkedin-in"></i>
             </a>
             <a href="https://www.youtube.com" target='_blank' title="Join us on Youtube">
                 <i class="fa-brands fa-youtube"></i>
             </a>
             <a href="https://www.instagram.com/mohit.206054" target='_blank' title="Join us on Instagram">
                 <i class="fa-brands fa-instagram"></i>
             </a>
         </div>
     </div>
     <div id="footerElements">
         <a href="tel:8368710101">Call Us</a>
         <a href='https://wa.me/8368710101'>WhatsApp Us</a>
     </div>
     <p><small>Copyright &copy;2021. All Rights Reserved.</small></p>
 </footer>