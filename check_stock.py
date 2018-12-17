#!/usr/bin/python  
import sys  
import os
import configparser
import psycopg2
import smtplib
import email.message
import cgi
from email.mime.text import MIMEText

def revizar_stock(arg1):
    """ Capturtar parametro en variable """
    min_stock = arg1
    verficar_parametro(min_stock)
    """ Variable para conectar con PostgreSQL """
    conn = None
    try:
        # Lectura de parametros de conexion
    	path = os.path.abspath(os.path.dirname(sys.argv[0]))
    	config = configparser.RawConfigParser()
    	config.read(path + '\\ConfigFile.properties')
        # Conectar a PostgreSql
    	print('Conectando a la base de datos de PostgreSQL...')
    	conn = psycopg2.connect(user = config.get('postgresql', 'user'),
                                  	 	  	password = config.get('postgresql', 'password'),
                                 	 		host = config.get('postgresql', 'host'),
                                  	 		port = config.get('postgresql', 'port'),
                                  	 		database = config.get('postgresql', 'database'))

        # Se crea cursor para realizar consultas a la base de datos
    	cursor = conn.cursor()
        
 		# execute a statement
    	print('Version de la db PostgreSQL:')
    	cursor.execute('SELECT version()')
 
        # display the PostgreSQL database server version
    	db_version = cursor.fetchone()
    	print(db_version)
    	cursor.execute("""SELECT products.id_product, products.name, products.description, categories.name, products.stock 
    						FROM products 
    						INNER JOIN categories 
    						ON categories.category_id = products.id_category 
    						AND stock <= %s""" % min_stock)	
    	rows=cursor.fetchall()
    
    	enviar_email(min_stock, config, rows)
     	
     	# Se cierra la conexion del cursor
    	cursor.close()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()
            print('Base de Datos conexion terminada')
 
def verficar_parametro(min_stock):
 	try:
 		float(min_stock)
 	except Exception:
 		print('**** Parametro ingresado para revizar el minimo de stock no es numerico ***')
 		sys.exit()
 	
 
def enviar_email(min_stock, config, rows):
	lista_productos = ''
	if rows:
		for row in rows:
			lista_productos = lista_productos + '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>' % (row[0], row[1], row[2], row[3], row[4])
	else:
		lista_productos = 'Estamos bien en stock'
	email_content = """
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			   <style type="text/css">
			    @import url('https://fonts.googleapis.com/css?family=Amarante');

				html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
				  margin: 0;
				  padding: 0;
				  border: 0;
				  font-size: 100%;
				  font: inherit;
				  vertical-align: baseline;
				  outline: none;
				  -webkit-font-smoothing: antialiased;
				  -webkit-text-size-adjust: 100%;
				  -ms-text-size-adjust: 100%;
				  -webkit-box-sizing: border-box;
				  -moz-box-sizing: border-box;
				  box-sizing: border-box;
				}
				html { overflow-y: scroll; }
				body { 
				  background: #eee url('https://i.imgur.com/eeQeRmk.png'); /* https://subtlepatterns.com/weave/ */
				  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
				  font-size: 62.5%;
				  line-height: 1;
				  color: #585858;
				  padding: 22px 10px;
				  padding-bottom: 55px;
				}

				::selection { background: #5f74a0; color: #fff; }
				::-moz-selection { background: #5f74a0; color: #fff; }
				::-webkit-selection { background: #5f74a0; color: #fff; }

				br { display: block; line-height: 1.6em; } 

				article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
				ol, ul { list-style: none; }

				input, textarea { 
				  -webkit-font-smoothing: antialiased;
				  -webkit-text-size-adjust: 100%;
				  -ms-text-size-adjust: 100%;
				  -webkit-box-sizing: border-box;
				  -moz-box-sizing: border-box;
				  box-sizing: border-box;
				  outline: none; 
				}

				blockquote, q { quotes: none; }
				blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
				strong, b { font-weight: bold; } 

				table { border-collapse: collapse; border-spacing: 0; }
				img { border: 0; max-width: 100%; }

				h1 { 
				  font-family: 'Amarante', Tahoma, sans-serif;
				  font-weight: bold;
				  font-size: 2.6em;
				  line-height: 1.7em;
				  margin-bottom: 10px;
				  text-align: center;
				}


				/** page structure **/
				#wrapper {
				  display: block;
				  width: 850px;
				  background: #fff;
				  margin: 0 auto;
				  padding: 10px 17px;
				  -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
				}

				#keywords {
				  margin: 0 auto;
				  font-size: 1.2em;
				  margin-bottom: 15px;
				}


				#keywords thead {
				  cursor: pointer;
				  background: #c9dff0;
				}
				#keywords thead tr th { 
				  font-weight: bold;
				  padding: 12px 30px;
				  padding-left: 42px;
				}
				#keywords thead tr th span { 
				  padding-right: 20px;
				  background-repeat: no-repeat;
				  background-position: 100% 100%;
				}

				#keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
				  background: #acc8dd;
				}

				#keywords thead tr th.headerSortUp span {
				  background-image: url('https://i.imgur.com/SP99ZPJ.png');
				}
				#keywords thead tr th.headerSortDown span {
				  background-image: url('https://i.imgur.com/RkA9MBo.png');
				}


				#keywords tbody tr { 
				  color: #555;
				}
				#keywords tbody tr td {
				  text-align: center;
				  padding: 15px 10px;
				}
				#keywords tbody tr td.lalign {
				  text-align: left;
				}
			</style>
		</head>	
	<body>
	 <div id="wrapper">
	  <h1>Articulos con Stock inferior o igual: """ + min_stock + """</h1>
	  <table id="keywords" cellspacing="0" cellpadding="0">
	    <thead>
	      <tr>
	        <th><span>ID</span></th>
	        <th><span>Nombre</span></th>
	        <th><span>Descripcion</span></th>
	        <th><span>Categoria</span></th>
	        <th><span>Stock</span></th>
	      </tr>
	    </thead>
	    <tbody>""" + lista_productos + """</tbody>
	   </table>
	  </div
	 </body>
	</html>""" 
	
	msg = email.message.Message()
	msg['Subject'] = config.get('email', 'subject')
	msg['From'] = config.get('email', 'from')
	msg['To'] = config.get('email', 'to')
	print('Enviando Email....')
	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.starttls()
	server.login(config.get('email', 'from'), config.get('email', 'password'))
	msg.add_header('Content-Type', 'text/html')
	msg.set_payload(email_content)
	server.sendmail(config.get('email', 'subject'), config.get('email', 'to'), msg.as_string())
	server.quit()
	print('Email Enviado')

if __name__ == "__main__": 
    revizar_stock(sys.argv[1]) 