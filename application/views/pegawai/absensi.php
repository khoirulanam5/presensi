<style>
   .content-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
   }

   .form-container {
      width: 45%; /* Sesuaikan lebar form */
      margin-right: 10px;
   }

   .map-container {
      width: 100%; /* Sesuaikan lebar peta */
   }

   #map {
      width: 100%; /* Peta akan menyesuaikan lebar kontainer map-container */
      height: 400px;
      border-radius: 8px;
   }

   /* Media query untuk layar kecil */
   @media (max-width: 768px) {
      .content-container {
         flex-direction: column;
      }

      .form-container, .map-container {
         width: 100%;
         margin-right: 0;
         margin-top: 20px;
      }
   }
</style>
<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <h5>Presensi Pegawai</h5>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Form Presensi Pegawai</h4>
                  <p>Silakan lakukan presensi dengan mengisi lokasi (geolocation) dan mengambil selfie langsung.</p>
               </div>
               <div class="card-body">
                  <?= $this->session->flashdata('pesan') ?>
                  <form action="<?= base_url('pegawai/absensi/absensi') ?>" method="POST">

                     <div>
                        <video id="camera" autoplay playsinline width="100%" height="100%"></video>
                        <canvas id="snapshot" style="display:none;"></canvas>
                        <button type="button" class="btn btn-primary mt-2" onclick="takeSnapshot()">Ambil Gambar</button>
                     </div>
                     
                     <!-- Hidden Field untuk Selfie Data -->
                     <input type="hidden" name="selfie_data" id="selfie_data">
                     <input type="hidden" id="absensi_type" name="absensi_type" value="masuk">
                     
                     <!-- Tombol Absen Masuk dan Keluar -->
                     <button type="submit" onclick="setAbsensiType('masuk')" class="btn btn-primary mt-3" 
                        <?php echo ($is_absent_today) ? 'disabled' : ''; ?>>Absen Masuk</button>
                     <button type="submit" onclick="setAbsensiType('keluar')" class="btn btn-primary mt-3" 
                        <?php echo ($has_checked_out_today) ? 'disabled' : ''; ?>>Absen Keluar</button>
                  </form>
               </div>
            </div>
         </div>

         <!-- Map Container -->
         <div class="map-container">
            <div id="map"></div>
         </div>
      </div>
   </div>
</div>

<!-- Script untuk Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?AIzaSyDDzhMwDLCt5VlMmkeXz2RXVEPy6nCDCKY&callback=initMap" async defer></script>
<script>
   function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), { zoom: 15, mapTypeId: 'roadmap' });
      const marker = new google.maps.Marker({ map: map, title: "Lokasi Anda" });

      if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(function (position) {
            const userLocation = { lat: position.coords.latitude, lng: position.coords.longitude };
            map.setCenter(userLocation);
            marker.setPosition(userLocation);
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
         }, function () {
            alert("Tidak dapat mendeteksi lokasi Anda.");
         });
      } else {
         alert("Geolocation tidak didukung oleh browser ini.");
      }
   }

   function setAbsensiType(type) {
      document.getElementById("absensi_type").value = type;
   }
</script>

<script>
   const camera = document.getElementById('camera');
   const snapshot = document.getElementById('snapshot');
   const selfieDataInput = document.getElementById('selfie_data');

   navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => { camera.srcObject = stream; })
      .catch(error => { console.error("Tidak dapat mengakses kamera:", error); });

   function takeSnapshot() {
      const context = snapshot.getContext('2d');
      snapshot.width = camera.videoWidth;
      snapshot.height = camera.videoHeight;
      context.drawImage(camera, 0, 0, snapshot.width, snapshot.height);
      selfieDataInput.value = snapshot.toDataURL('image/png');
      alert("Foto berhasil diambil!");
   }
</script>
