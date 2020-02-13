pipeline {
    agent any
 
    options {
        skipDefaultCheckout(true)
    }
 
    stages {
        stage('Git') {
            steps {
                echo '> Test 1 ...'
                sh '''
                 pwd
                 whoami
                 ls -alt
                 sudo service httpd status
                 httpd -v
                '''
            }
        }
        stage('Build') {
            steps {
                echo '> Test 2 ...'
                sh 'pwd'
            }
        }
        stage('Push') {
            steps {
                echo '> Test 3 ...'
                sh 'pwd'
            }
        }
        stage('Destroy') {
            steps {
                echo '> Test 4 ...'
                sh 'pwd'
            }
        }
        stage('Deploy') {
            steps {
                echo '> Test 4 ...'
                sh 'pwd'
            }
        }
    }
}
