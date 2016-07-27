import java.net.*;
import java.io.*;
public class TpcClient {

	public static void main(String[] args) throws Exception{
		Socket s = new Socket("127.0.0.1",8888);
		InputStreamReader w = new BufferedWriter(new OutputStreamWriter(s.getOutputStream()));
		BufferedReader rw = null;
		
		String line = null;
		do{
			rw = new InputStreamReader(System.in);
			line = rw.readLine();
			w.write(line);
			line = rw.readLine();
		}while(!line.equals("bye"));
		
		w.close();
		s.close();
		rw.close();
	}

}
