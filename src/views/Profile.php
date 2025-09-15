<?php ob_start(); ?>
  <div class="max-w-6xl mx-auto rounded-xl shadow-xl overflow-hidden bg-gray-800/70 backdrop-blur-lg border border-gray-700 mb-4">
    <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-700">

      <div class="lg:w-1/3 flex flex-col items-center p-8 text-center relative">
        
        <a href="/profile/edit" class="absolute top-4 right-4 px-4 py-2 text-sm font-semibold rounded-full bg-gray-700/50 text-gray-300 hover:bg-gray-600/70 transition-colors duration-200">
            Edit Profile
        </a>

        <div class="w-40 h-40 rounded-full overflow-hidden bg-gray-700 mb-6 border-4 border-blue-500">
          <img src="https://i.ibb.co/6P0P4vM/jim-carrey-profile.jpg" alt="Jim Carrey" class="w-full h-full object-cover">
        </div>

        <h1 class="text-3xl font-bold text-white">Jim Carrey</h1>
        <p class="text-sm uppercase tracking-widest text-gray-400 font-medium mb-8">ACTOR</p>

        <div class="w-full text-left border-t border-gray-700 pt-6 mt-6">
          <h2 class="text-lg font-bold text-gray-300 mb-2">General</h2>
          <ul class="text-gray-400 space-y-2">
            <li><span class="font-medium text-white">Experience:</span> 5 years</li>
            <li><span class="font-medium text-white">Salary:</span> €1000</li>
          </ul>
        </div>

        <div class="w-full text-left border-t border-gray-700 pt-6 mt-6">
          <h2 class="text-lg font-bold text-gray-300 mb-2">Languages</h2>
          <ul class="text-gray-400 space-y-2">
            <li>English</li>
            <li>Mandarin</li>
            <li>Hindi</li>
            <li>Spanish</li>
          </ul>
        </div>
      </div>

      <div class="lg:w-2/3 p-8">
        <h2 class="text-2xl font-bold text-white mb-4">Professional summary</h2>
        <p class="text-gray-300 leading-relaxed mb-8">
          James Eugene Carrey is a Canadian and American actor and comedian. Known for his energetic
          slapstick performances, Carrey first gained recognition in 1990 after landing a role in the American
          sketch comedy television series In Living Color (1990–1994). He broke out as a star in motion
          pictures with Ace Ventura: Pet Detective, The Mask and Dumb and Dumber (all 1994). This was
          followed up with Ace Ventura: When Nature Calls, Batman Forever (both 1995), and Liar Liar (1997).
        </p>

        <h2 class="text-2xl font-bold text-white mb-4">Skills</h2>
        <div class="flex flex-wrap gap-3">
          <span class="px-4 py-2 text-sm font-medium rounded-full border border-blue-500 text-blue-400">Problem-solving</span>
          <span class="px-4 py-2 text-sm font-medium rounded-full border border-blue-500 text-blue-400">Computer skills</span>
          <span class="px-4 py-2 text-sm font-medium rounded-full border border-blue-500 text-blue-400">Management skills</span>
        </div>
      </div>
    </div>
  </div>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>