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
      <button id="edit-profile-btn" class="absolute top-4 right-4 px-4 py-2 text-sm font-semibold rounded-full bg-gray-700/50 text-gray-300 hover:bg-gray-600/70 transition-colors duration-200">
        Edit Profile
      </button>

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
            <?php if (!empty(trim($lang))): ?>
              <li><?= htmlspecialchars(trim($lang)) ?></li>
            <?php endif; ?>
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
          <?php if (!empty(trim($skill))): ?>
            <span class="px-4 py-2 text-sm font-medium rounded-full border border-blue-500 text-blue-400">
              <?= htmlspecialchars(trim($skill)) ?>
            </span>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<div id="edit-profile-modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
  <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-2xl border border-gray-700">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-2xl font-bold text-white">Edit Profile</h3>
      <button class="close-modal text-gray-400 hover:text-white text-3xl font-light leading-none">&times;</button>
    </div>
    <form id="edit-profile-form" action="<?= htmlspecialchars($_ENV['BASE_URL'] . '/profile/update') ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user']['id'] ?? '') ?>">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="full-name" class="block text-gray-300 mb-1">Full Name</label>
          <input type="text" id="full-name" name="name" value="<?= htmlspecialchars($name) ?>" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label for="profession" class="block text-gray-300 mb-1">Profession</label>
          <input type="text" id="profession" name="profession" value="<?= htmlspecialchars($profile['profession'] ?? '') ?>" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label for="experience" class="block text-gray-300 mb-1">Experience (e.g., 5 years)</label>
          <input type="text" id="experience" name="experience" value="<?= htmlspecialchars($experience) ?>" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label for="salary" class="block text-gray-300 mb-1">Salary (e.g., ₹50000)</label>
          <input type="text" id="salary" name="salary" value="<?= htmlspecialchars($salary) ?>" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label for="languages" class="block text-gray-300 mb-1">Languages (comma-separated)</label>
          <input type="text" id="languages" name="languages" value="<?= htmlspecialchars($profile['languages'] ?? '') ?>" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label for="skills" class="block text-gray-300 mb-1">Skills (comma-separated)</label>
          <input type="text" id="skills" name="skills" value="<?= htmlspecialchars($profile['skills'] ?? '') ?>" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
      </div>

      <div class="mb-6">
        <label for="bio" class="block text-gray-300 mb-1">Professional Summary</label>
        <textarea id="bio" name="bio" rows="4" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($bio) ?></textarea>
      </div>

      <div class="mb-6">
        <label for="profile_pic" class="block text-gray-300 mb-1">Profile Picture</label>
        <input type="file" id="profile_pic" name="profile_pic" class="w-full text-gray-400">
        <input type="hidden" name="profile_url" value="<?= htmlspecialchars($profile['profile_url'] ?? '../src/Assets/default-user-pfp.png') ?>">
      </div>

      <div class="flex justify-end pt-4">
        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
  const editProfileBtn = $('#edit-profile-btn');
  const editProfileModal = $('#edit-profile-modal');
  const closeModalBtn = $('.close-modal');

  editProfileBtn.on('click', function() {
    editProfileModal.removeClass('hidden');
  });

  closeModalBtn.on('click', function() {
    editProfileModal.addClass('hidden');
  });

  $(window).on('click', function(event) {
    if ($(event.target).is(editProfileModal)) {
      editProfileModal.addClass('hidden');
    }
  });
});
</script>

<?php
  $content = ob_get_clean();
  require __DIR__ . '/Layout.php';
?>