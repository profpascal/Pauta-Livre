create database ebc;
use ebc;

create table `tb_usuario`(
	id_usuario int not null auto_increment,
    nm_usuario varchar(100) not null,
    nm_email varchar (100) not null,
    nm_senha varchar(60) not null,
    vl_votos int not null default 0,
    ie_ativo boolean not null default true,
    constraint pk_tb_usuario primary key (id_usuario)
);

create table `tb_pauta`(
	id_pauta int not null auto_increment,
	id_usuario int not null,
    nm_titulo varchar(60) not null,
    nm_detalhes text not null,
    ie_categoria int not null,
    dt_envio date not null,
    
    constraint pk_tb_pauta primary key(id_pauta),
    constraint fk_tb_pauta_usuario foreign key(id_usuario) references `tb_usuario` (`id_usuario`)
    
);

create table `tb_voto`(
	id_usuario int not null,
    id_pauta int not null,
    
    constraint pk_tb_voto primary key(id_usuario, id_pauta),
    constraint fk_tb_voto_usuario foreign key(id_usuario) references `tb_usuario` (`id_usuario`),
    constraint fk_tb_voto_pauta foreign key(id_pauta) references `tb_pauta` (`id_pauta`)
); 

create table `tb_comentario`(
    id_comentario int not null auto_increment,
    id_usuario int not null,
    id_pauta int not null,
    nm_comentario text not nul
    l,
    
    constraint pk_tb_comentario primary key(id_comentario),
    constraint fk_tb_comentario_usuario foreign key(id_usuario) references `tb_usuario` (`id_usuario`),
    constraint fk_tb_comentario_pauta foreign key(id_pauta) references `tb_pauta` (`id_pauta`)
); 
