<?php ob_start(); ?>
<?php
$profile = $data['profile'] ?? [];
$name = $_SESSION['user']['name'] ?? 'User';
$profession = strtoupper($profile['profession'] ?? 'Not specified');
$experience = $profile['experience'] ?? 'N/A';
$salary = $profile['salary'] ?? 'N/A';
$languages = explode(',', $profile['languages'] ?? '');
$skills = explode(',', $profile['skills'] ?? '');
$bio = $profile['bio'] ?? 'No bio available.';
$avatar = $profile['profile_url'] ?: '../src/Assets/default-user-pfp.png';
?>
<div class="max-w-6xl mx-auto rounded-xl shadow-xl overflow-hidden bg-gray-800/70 backdrop-blur-lg border border-gray-700 mb-4">
  <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-700">

    <div class="lg:w-1/3 flex flex-col items-center p-8 text-center relative">
      <a href="/profile/edit" class="absolute top-4 right-4 px-4 py-2 text-sm font-semibold rounded-full bg-gray-700/50 text-gray-300 hover:bg-gray-600/70 transition-colors duration-200">
        Edit Profile
      </a>

      <div class="w-40 h-40 rounded-full overflow-hidden bg-gray-700 mb-6 border-4 border-blue-500">
        <img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($name) ?>" class="w-full h-full object-cover">
      </div>

      <h1 class="text-3xl font-bold text-white"><?= htmlspecialchars($name) ?></h1>
      <p class="text-sm uppercase tracking-widest text-gray-400 font-medium mb-8"><?= htmlspecialchars($profession) ?></p>

      <div class="w-full text-left border-t border-gray-700 pt-6 mt-6">
        <h2 class="text-lg font-bold text-gray-300 mb-2">General</h2>
        <ul class="text-gray-400 space-y-2">
          <li><span class="font-medium text-white">Experience:</span> <?= htmlspecialchars($experience) ?></li>
          <li><span class="font-medium text-white">Salary:</span> ₹<?= htmlspecialchars($salary) ?></li>
        </ul>
      </div>

      <div class="w-full text-left border-t border-gray-700 pt-6 mt-6">
        <h2 class="text-lg font-bold text-gray-300 mb-2">Languages</h2>
        <ul class="text-gray-400 space-y-2">
          <?php foreach ($languages as $lang): ?>
            <li><?= htmlspecialchars(trim($lang)) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="lg:w-2/3 p-8">
      <h2 class="text-2xl font-bold text-white mb-4">Professional summary</h2>
      <p class="text-gray-300 leading-relaxed mb-8">
        <?= nl2br(htmlspecialchars($bio)) ?>
      </p>

      <h2 class="text-2xl font-bold text-white mb-4">Skills</h2>
      <div class="flex flex-wrap gap-3">
        <?php foreach ($skills as $skill): ?>
          <span class="px-4 py-2 text-sm font-medium rounded-full border border-blue-500 text-blue-400">
            <?= htmlspecialchars(trim($skill)) ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>