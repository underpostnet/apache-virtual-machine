@echo off
net.exe session 1>NUL 2>NUL || goto :not_admin
echo SUCCESS
goto :eof

:not_admin
echo ERROR
exit /b 1
