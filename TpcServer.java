import java.net.*;
import java.io.*;

import javax.sound.midi.SysexMessage;
public class TpcServer {
	public static void main(String[] args){
		ServerSocket ss = null;
		Socket client = null;
		try{
			ss = new ServerSocket(8888);
			System.out.println("连接完成");
		}catch(IOException e){
			System.out.println(e.getMessage());System.exit(-1);
		}
		
		while(true){
			try{
				client = ss.accept();
				System.out.println(new BufferedReader(new InputStreamReader(client.getInputStream())).readLine());
			}catch(IOException e){
				System.out.println(e.getMessage());
			}
		}
	}	
}

class ClientSocket implements Runnable{
	private Socket s = null;
	public ClientSocket(Socket s){
		this.s = s;
	}
	public void run(){
		try{
			
			BufferedReader clientInStream = new BufferedReader(new InputStreamReader(this.s.getInputStream()));
			System.out.println(clientInStream.readLine());
			
			
			BufferedReader sysin = new BufferedReader(new InputStreamReader(System.in));
			BufferedWriter clientOutStream  = new BufferedWriter(new OutputStreamWriter(this.s.getOutputStream()));
			String line = sysin.readLine();
			
			System.out.println(line);
			while(!line.equals("bye")){
				clientOutStream.write(line);
			}
			
			clientInStream.close();
			
			clientOutStream.flush();
			clientOutStream.close();
			sysin.close();
			this.s.close();
		}catch(IOException e){
			System.out.println(e.getMessage());
		}
	}
}
