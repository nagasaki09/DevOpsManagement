path C:\Program Files\Git\bin;%PATH%
git.exe --version

::dir

:: pull
::git.exe pull --progress --no-rebase -v "origin"

:: commit
::git.ext commit

:: push
::git.exe push --progress "origin" master:master

:: change public branch
git.exe checkout public --

:: merge master
git.exe merge master

:: push public
git.exe push --progress "origin" public

:: change master branch
git.exe checkout master --

pause