<?php
return [

  'debug'  => false,

  'thathoff.git-content' => [
    'commit' => true,
    'push' => false, // Set to true to auto-push to remote
    'commitMessage' => 'Content updated via Kirby Panel',
    'gitBin' => 'git',
    'windowsMode' => false,
    'cronHooksEnabled' => false, // Set to true for batch commits
    'cronHooksInterval' => 10, // Minutes between commits
  ],

];
