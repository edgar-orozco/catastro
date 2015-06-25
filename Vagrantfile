# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "Test"

  #config.vm.provision :shell, :path => "bootstrap.sh"

  config.vm.network :private_network, ip: "192.168.50.10"

  config.vm.synced_folder ".", "/vagrant", disabled: true
  config.vm.synced_folder ".", "/elvagrant"

  # Habilitar y configurar Punto de montaje de archivos del proyecto

  config.vm.synced_folder "/home/devch/DGT", "/var/www/html"

  config.vm.hostname = "catastro-dev"

    config.vm.provider "virtualbox" do |vb|
      vb.name = "Test de Desarrollo Local"
      vb.customize ["modifyvm", :id, "--memory", "512"]
  end
end
