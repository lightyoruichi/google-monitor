set :application, "google-monitor"
set :deploy_to,   "/var/www/google-monitor.tekiela.pl"
set :domain,      "google-monitor.tekiela.pl"
set :user,        "root"

set :scm,         :git
set :repository,  "git://github.com/wtekiela/google-monitor.git"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Rails migrations will run

set   :use_sudo,      false
set   :keep_releases, 3

set :shared_files,      ["app/config/parameters.ini"]
set :shared_children,   [app_path + "/cache", app_path + "/logs", web_path + "/uploads", "vendor"]
set :update_vendors,    true