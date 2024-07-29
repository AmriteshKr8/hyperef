import java.util.Arrays;
import java.util.Scanner;

public class LargestOddAlternatingSum {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        
        // Take input array length
        
        int n = scanner.nextInt();
        
        // Take input array elements
        int[] array = new int[n];
        
        for (int i = 0; i < n; i++) {
            array[i] = scanner.nextInt();
        }

        // Find the sum of the three largest odd alternating integers
        int sum = findSumOfLargestOddAlternating(array);
        System.out.println("" + sum);
    }
    
    private static int findSumOfLargestOddAlternating(int[] array) {
        // Sort the array in descending order
        Arrays.sort(array);
        int n = array.length;
        int[] sortedArray = new int[n];
        
        // Reverse the sorted array to make it descending
        for (int i = 0; i < n; i++) {
            sortedArray[i] = array[n - 1 - i];
        }
        
        int count = 0;
        int sum = 0;
        
        // Initialize lastSign to 0 (neutral)
        int lastSign = 0;
        
        for (int i = 0; i < n && count < 3; i++) {
            // Check if the current number is odd
            if (sortedArray[i] % 2 != 0) {
                // Get the current sign of the number
                int currentSign = (sortedArray[i] > 0) ? 1 : -1;
                
                // Check if the current number alternates in sign with the previous number
                if (lastSign == 0 || currentSign != lastSign) {
                    sum += sortedArray[i];
                    count++;
                    lastSign = currentSign;
                }
            }
        }
        
        // If less than 3 odd alternating numbers are found, sum would be invalid
        if (count < 3) {
            
            return 0;
        }
        
        return sum;
    }
}
