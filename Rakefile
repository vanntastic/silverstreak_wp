namespace :ss do
  
  desc 'Setup the files for the wordpress theme'
  task :setup do
    if ENV['FOR'].nil?
      puts "USAGE : rake ss:setup FOR=theme_name"
      exit
    else
      theme_path = File.join("../", ENV['FOR'])
      system("mkdir -p #{theme_path}")
      system("mkdir -p #{File.join(theme_path, 'images')}")
      system("mkdir -p #{File.join(theme_path, 'css')}")
      system("mkdir -p #{File.join(theme_path, 'js')}")
      system("rsync -aC js/* #{File.join(theme_path, 'js')}")
      system("cp -R css/* #{File.join(theme_path, 'css')}")
      system("cp .gitmodules #{File.join(theme_path, ".gitmodules")}")
      system("touch #{File.join(theme_path, 'functions.php')}")
      
      File.open(File.join(theme_path, "style.css"), "w+") do |file|
        file << "
/*
  THEME NAME: #{ENV['FOR']}
  THEME URI: your-theme-name.com
  DESCRIPTION: A Description for #{ENV['FOR']}
  VERSION: 1.0
  AUTHOR: Your name
  AUTHOR URI: http://youraddress.com
  TAGS: simple, basic, barebones
  TEMPLATE: silverstreak_wp
*/"
        end
      end
      
      template_files = %w(404.php archive.php comments.php footer.php header.php index.php
                          page.php screenshot.png searchform.php sidebar.php single.php)     
      
      template_files.each do |file|
        system "cp #{file} #{File.join(theme_path, file)}"
      end
      
      puts "Your theme : #{ENV['FOR']} has been successfully setup!"
      system("mate #{File.join(theme_path, 'header.php')}") if system("mate")
      
  end
  
end
